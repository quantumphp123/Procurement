<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        // $query = Enquiry::where('seller_id', Auth::id())
        //     ->with(['customer', 'product']);

        // // Search functionality
        // if ($request->has('search') && !empty($request->search)) {
        //     $search = $request->search;
        //     $query->where(function($q) use ($search) {
        //         $q->where('enquiry_number', 'like', "%{$search}%")
        //           ->orWhere('company_name', 'like', "%{$search}%")
        //           ->orWhereHas('customer', function($customerQuery) use ($search) {
        //               $customerQuery->where('name', 'like', "%{$search}%")
        //                            ->orWhere('company_name', 'like', "%{$search}%");
        //           });
        //     });
        // }

        // // Filter by status
        // if ($request->has('status') && !empty($request->status)) {
        //     $query->where('status', $request->status);
        // }

        // // Filter by date range
        // if ($request->has('date_from') && !empty($request->date_from)) {
        //     $query->whereDate('created_at', '>=', $request->date_from);
        // }

        // if ($request->has('date_to') && !empty($request->date_to)) {
        //     $query->whereDate('created_at', '<=', $request->date_to);
        // }

        // $enquiries = $query->latest()->paginate(15);

        // return view('seller.enquiries.index', compact('enquiries'));
        return view('seller.enquiries.index');
    }

    public function show($id)
    {
        $enquiry = Enquiry::where('seller_id', Auth::id())
            ->with(['customer', 'product', 'messages'])
            ->findOrFail($id);

        // Mark as viewed
        if (!$enquiry->viewed_at) {
            $enquiry->update(['viewed_at' => now()]);
        }

        return view('seller.enquiries.show', compact('enquiry'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'price' => 'nullable|numeric|min:0',
            'delivery_time' => 'nullable|string|max:100',
        ]);

        $enquiry = Enquiry::where('seller_id', Auth::id())->findOrFail($id);

        // Create response message
        $enquiry->messages()->create([
            'sender_type' => 'seller',
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
        ]);

        // Update enquiry status
        $enquiry->update([
            'status' => 'responded',
            'responded_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Response sent successfully!');
    }

    public function search(Request $request)
    {
        $search = $request->get('q');

        $enquiries = Enquiry::where('seller_id', Auth::id())
            ->where(function($query) use ($search) {
                $query->where('enquiry_number', 'like', "%{$search}%")
                      ->orWhere('company_name', 'like', "%{$search}%");
            })
            ->with(['customer', 'product'])
            ->latest()
            ->limit(10)
            ->get();

        return response()->json([
            'enquiries' => $enquiries->map(function($enquiry) {
                return [
                    'id' => $enquiry->id,
                    'enquiry_number' => $enquiry->enquiry_number,
                    'company_name' => $enquiry->company_name,
                    'customer_name' => $enquiry->customer->name ?? '',
                    'received_date' => $enquiry->created_at->format('d/m/Y'),
                    'status' => $enquiry->status,
                ];
            })
        ]);
    }
}
