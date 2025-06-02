<?php

namespace App\Http\Controllers\Seller;

use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\SubmitQuotationRequest;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{
    // Display enquiries
    public function index(Request $request)
    {
        // Get all category IDs for the authenticated seller's products
        $sellerCategoryIds = Product::where('user_id', Auth::id())
            ->pluck('category_id')
            ->unique()
            ->toArray();

        // Get enquiries that have items in the seller's product categories
        $query = Enquiry::whereHas('enquiry_items', function ($q) use ($sellerCategoryIds) {
            $q->whereIn('category_id', $sellerCategoryIds);
        })->with(['user']);

        // Apply search filter if search parameter is present and not empty
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                // Search by enquiry number or company name or user name
                $q->where('enquiry_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                        //->orWhere('company_name', 'like', "%{$search}%");
                    });
            });
        }

        $enquiries = $query->latest()->paginate(10);

        return view('seller.enquiries.index', compact('enquiries'));
    }

    // Show details of a specific enquiry by its ID
    public function show($id)
    {
        // Get seller's category IDs to filter enquiry items
        $sellerCategoryIds = Product::where('user_id', Auth::id())
            ->pluck('category_id')
            ->unique()
            ->toArray();

        $enquiry = Enquiry::with([
            'user',
            'enquiry_items' => function ($query) use ($sellerCategoryIds) {
                // Only show enquiry items that match seller's product categories
                $query->whereIn('category_id', $sellerCategoryIds);
            },
            'enquiry_items.category'
        ])
            ->findOrFail($id);

        return view('seller.enquiries.show', compact('enquiry'));
    }

    // Submit quotation
    public function submitQuotation(SubmitQuotationRequest $request, $enquiryId)
    {
        try {
            // Validate request
            $validated = $request->validated();

            // Fetch the enquiry
            $enquiry = Enquiry::findOrFail($enquiryId);

            // Calculate totals
            $totalPrice = 0;
            foreach ($validated['items'] as $item) {
                $totalPrice += $item['unit_price'] * $item['quantity'];
            }

            $discountPercentage = $validated['discount_percentage'] ?? 0;
            $vatPercentage = $validated['vat_percentage'] ?? 0;

            $discountAmount = ($discountPercentage / 100) * $totalPrice;
            $discountedPrice = $totalPrice - $discountAmount;

            $vatAmount = ($vatPercentage / 100) * $discountedPrice;
            $finalPrice = $discountedPrice + $vatAmount;

            // Create quotation
            $quotation = Quotation::create([
                'enquiry_id' => $enquiry->id,
                'user_id' => Auth::id(),
                'quotation_number' => 'QTN-' . strtoupper(uniqid()),
                'total_price' => $totalPrice,
                'discount_percentage' => $discountPercentage,
                'discounted_price' => $discountedPrice,
                'vat_percentage' => $vatPercentage,
                'final_price' => $finalPrice,
                'status' => 'pending',
            ]);

            // Create quotation items
            foreach ($validated['items'] as $item) {
                $itemTotalPrice = $item['unit_price'] * $item['quantity'];

                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'enquiry_item_id' => $item['enquiry_item_id'],
                    'item_name' => $item['item_name'] ?? null,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $itemTotalPrice,
                    'remarks' => $item['remarks'] ?? null,
                ]);
            }

            // Update enquiry status
            $enquiry->update(['status' => 'quoted']);

            // Return response
            return response()->json([
                'success' => true,
                'message' => 'Quotation submitted successfully!',
                'redirect' => route('seller.enquiries.index'),
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the quotation. Please try again.'
            ], 500);
        }
    }


    /**
     * Decline an enquiry
     */
    public function declineEnquiry($enquiryId)
    {
        try {
            $enquiry = Enquiry::findOrFail($enquiryId);

            // Update enquiry status to declined
            $enquiry->update([
                'status' => 'declined',
                'declined_at' => now(),
                'declined_by' => Auth::id() // Optional: track who declined it
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Enquiry declined successfully!',
                'redirect' => route('seller.enquiries.index')
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Enquiry not found.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Enquiry decline error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while declining the enquiry.'
            ], 500);
        }
    }
}
