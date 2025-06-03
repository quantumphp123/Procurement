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
use Illuminate\Support\Facades\DB;

class EnquiryController extends Controller
{
    /**
     * Display enquiries assigned to this seller
     */
    public function index(Request $request)
    {
        $sellerId = Auth::id();

        // Get enquiries assigned to this seller through pivot table
        $query = Enquiry::whereHas('sellers', function ($q) use ($sellerId) {
            $q->where('seller_id', $sellerId);
        })
        ->with([
            'user',
            'enquiry_items.category',
            'sellers' => function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            }
        ]);

        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('enquiry_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status if provided
        if ($request->has('status') && !empty($request->status)) {
            $query->whereHas('sellers', function ($q) use ($sellerId, $request) {
                $q->where('seller_id', $sellerId)
                  ->where('enquiry_seller.status', $request->status);
            });
        }

        $enquiries = $query->latest()->paginate(10);

        return view('seller.enquiries.index', compact('enquiries'));
    }

    /**
     * Show details of a specific enquiry
     */
    public function show($id)
    {
        $sellerId = Auth::id();

        // Get seller's category IDs
        $sellerCategoryIds = Product::where('user_id', $sellerId)
            ->pluck('category_id')
            ->unique()
            ->toArray();

        // Get enquiry that is assigned to this seller
        $enquiry = Enquiry::whereHas('sellers', function ($q) use ($sellerId) {
            $q->where('seller_id', $sellerId);
        })
        ->with([
            'user',
            'enquiry_items' => function ($query) use ($sellerCategoryIds) {
                // Only show relevant items for this seller
                $query->whereIn('category_id', $sellerCategoryIds);
            },
            'enquiry_items.category',
            'sellers' => function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            }
        ])
        ->findOrFail($id);

        // Check if seller has access to this enquiry
        if (!$enquiry->isAssignedToSeller($sellerId)) {
            abort(403, 'You do not have access to this enquiry.');
        }

        return view('seller.enquiries.show', compact('enquiry'));
    }

    /**
     * Submit quotation
     */
    public function submitQuotation(SubmitQuotationRequest $request, $enquiryId)
    {
        try {
            $sellerId = Auth::id();
            $validated = $request->validated();

            // Check if seller has access to this enquiry
            $enquiry = Enquiry::whereHas('sellers', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->findOrFail($enquiryId);

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

            DB::beginTransaction();

            // Create quotation
            $quotation = Quotation::create([
                'enquiry_id' => $enquiry->id,
                'user_id' => $sellerId,
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

            // Update pivot table status
            $enquiry->sellers()->updateExistingPivot($sellerId, [
                'status' => 'quoted',
                'responded_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Quotation submitted successfully!',
                'redirect' => route('seller.enquiries.index'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotation submission error: ' . $e->getMessage());

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
            $sellerId = Auth::id();

            $enquiry = Enquiry::whereHas('sellers', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->findOrFail($enquiryId);

            // Update pivot table status to declined
            $enquiry->sellers()->updateExistingPivot($sellerId, [
                'status' => 'declined',
                'responded_at' => now()
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

    /**
     * Get seller's enquiry statistics
     */
    public function getStats()
    {
        $sellerId = Auth::id();

        $stats = [
            'total' => Enquiry::whereHas('sellers', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })->count(),

            'pending' => Enquiry::whereHas('sellers', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId)->where('enquiry_seller.status', 'pending');
            })->count(),

            'quoted' => Enquiry::whereHas('sellers', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId)->where('enquiry_seller.status', 'quoted');
            })->count(),

            'declined' => Enquiry::whereHas('sellers', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId)->where('enquiry_seller.status', 'declined');
            })->count(),
        ];

        return response()->json($stats);
    }
}
