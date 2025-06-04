<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerEnquiryRequest;
use App\Http\Requests\Customer\EnquiryItemRequest;
use App\Http\Requests\Customer\SubmitEnquiryFormRequest;
use App\Models\Admin\Category;
use App\Models\Customer\Enquiry;
use App\Models\Customer\EnquiryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Events\EnquirySubmitted;
use App\Models\Admin\Unit;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('customer.home', compact('categories'));
    }

    public function enquiryManagement()
    {
        return view('customer.enquiry.enquiry_management');
    }

    public function myQuotation()
    {
        return view('customer.quotation.my_quotation');
    }



    public function myOrders()
    {
        return view('customer.order.my_orders');
    }

    public function submitEnquiryForm(Request $request)
    {
        $customer = auth()->user()->customer;
        $categories = Category::all();
        $units = Unit::where('status', true)->get(); // Get active units

        $enquiryId = $request->input('id');
        $isEditMode = $request->boolean('edit', false);
        $isViewMode = $request->boolean('view', false);
        $enquiry = null;
        $enquiryItems = collect(); // Initialize as empty collection
        $enquiryNumber = null;

        if ($enquiryId) {
            // Fetch the specific enquiry with its items
            $enquiry = Enquiry::with('items')->where('user_id', auth()->id())->find($enquiryId);
            if ($enquiry) {
                $enquiryItems = $enquiry->items;
                $enquiryNumber = $enquiry->enquiry_number;
            } else {
                // Handle case where enquiry is not found or doesn't belong to the user
                return redirect()->route('enquiry.management')->with('error', 'Enquiry not found.');
            }
        } else {
            // Existing logic for new enquiry or latest enquiry
            $userId = auth()->id();
            $latestEnquiry = Enquiry::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->first();

            $enquiryNumber = $latestEnquiry ? $latestEnquiry->enquiry_number : null;
            $enquiryId = $latestEnquiry ? $latestEnquiry->id : null;
        }

        return view('customer.enquiry.submit_enquiry_form', compact('customer', 'categories', 'units', 'enquiryNumber', 'enquiryId', 'enquiryItems', 'isEditMode', 'isViewMode'));
    }

    public function viewQuotation()
    {
        return view('customer.quotation.view_quotation');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.enquiry.create');
    }

    /**
     * Store a newly created enquiry with items in storage.
     */
    public function storeItems(SubmitEnquiryFormRequest $request)
    {
        try {
            DB::beginTransaction();

            $isDraft = $request->boolean('draft', false);
            $isEdit = $request->boolean('is_edit', false);
            $enquiryId = $request->input('enquiry_id');

            if ($isEdit && $enquiryId) {
                // Update existing enquiry
                $enquiry = Enquiry::where('user_id', auth()->id())->findOrFail($enquiryId);
                $enquiry->update(['drafted' => $isDraft]);

                // Update or create enquiry items
                foreach ($request->items as $item) {
                    if (isset($item['id'])) {
                        // Update existing item
                        EnquiryItem::where('id', $item['id'])
                            ->where('enquiry_id', $enquiry->id)
                            ->update([
                                'category_id' => $item['category_id'],
                                'item_description' => $item['item_description'],
                                'manufacturer' => $item['manufacturer'],
                                'unit_id' => $item['unit_id'],
                                'qty' => $item['qty'],
                                'remark' => $item['remark'] ?? null
                            ]);
                    } else {
                        // Create new item
                        EnquiryItem::create([
                            'enquiry_id' => $enquiry->id,
                            'user_id' => auth()->id(),
                            'category_id' => $item['category_id'],
                            'item_description' => $item['item_description'],
                            'manufacturer' => $item['manufacturer'],
                            'unit_id' => $item['unit_id'],
                            'qty' => $item['qty'],
                            'remark' => $item['remark'] ?? null
                        ]);
                    }
                }

                DB::commit();

                $message = $isDraft ? 'Enquiry saved as draft.' : 'Enquiry updated successfully.';
                return redirect()->route('enquiry.management')
                    ->with('message', $message)
                    ->with('alert-type', 'success');

            } else {
                // Create new enquiry
                // Get the latest enquiry ID and increment it
                $latestEnquiry = Enquiry::orderBy('id', 'desc')->first();
                $nextId = $latestEnquiry ? $latestEnquiry->id + 1 : 1;
                $userId = auth()->id();

                // Get the latest sequence number for this user
                $latestUserEnquiry = Enquiry::where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->first();

                $sequence = 1;
                if ($latestUserEnquiry && preg_match('/ENQ_\d+_(\d+)/', $latestUserEnquiry->enquiry_number, $matches)) {
                    $sequence = (int)$matches[1] + 1;
                }

                // Generate enquiry number with user ID and sequence
                $enquiryNumber = 'ENQ_' . $userId . '_' . str_pad($sequence, 4, '0', STR_PAD_LEFT);

                // Create new enquiry with draft status
                $enquiry = Enquiry::create([
                    'id' => $nextId, // Explicitly set the ID
                    'user_id' => $userId,
                    'enquiry_number' => $enquiryNumber,
                    'drafted' => $isDraft
                ]);

                // Store the enquiry items
                foreach ($request->items as $item) {
                    EnquiryItem::create([
                        'enquiry_id' => $enquiry->id,
                        'user_id' => auth()->id(),
                        'category_id' => $item['category_id'],
                        'item_description' => $item['item_description'],
                        'manufacturer' => $item['manufacturer'],
                        'unit_id' => $item['unit_id'],
                        'qty' => $item['qty'],
                        'remark' => $item['remark'] ?? null
                    ]);
                }

                DB::commit();

                // Only fire the event if it's not a draft
                if (!$isDraft) {
                    event(new EnquirySubmitted($enquiry));
                }

                if ($isDraft) {
                    return redirect()->route('enquiry.management')
                        ->with('message', 'Enquiry saved as draft.')
                        ->with('alert-type', 'success');
                } else {
                    return redirect()->route('submit.enquiry.form')
                        ->with('showSuccessModal', true)
                        ->with('enquiryNumber', $enquiryNumber);
                }
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('message', 'Error processing enquiry. Please try again.')
                ->with('alert-type', 'error')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
