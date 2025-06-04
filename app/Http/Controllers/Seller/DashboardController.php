<?php

namespace App\Http\Controllers\Seller;

use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        try {
            // Get seller's product categories
            $sellerCategoryIds = Product::where('user_id', Auth::id())
                ->pluck('category_id')
                ->unique()
                ->toArray();

            // Build single enquiries query for both count and data
            $enquiriesQuery = $this->buildEnquiriesQuery($sellerCategoryIds, $request);

            // Get total count and recent enquiries
            $totalEnquiries = (clone $enquiriesQuery)->count();
            $recentEnquiries = $enquiriesQuery->latest()
                ->paginate($request->get('per_page', 8))
                ->appends($request->all());

            // Get all categories
            $categories = Category::all();

            return view('seller.dashboard', compact(
                'totalEnquiries',
                'categories',
                'recentEnquiries'
            ))->with('showSuccessModal', session('registration_success', false));
        } catch (\Exception $e) {
            return view('seller.dashboard', [
                'error' => 'Unable to load dashboard data. Please try again.'
            ]);
        }
    }

    /**
     * Build enquiries query with filters
     */
    private function buildEnquiriesQuery($sellerCategoryIds, Request $request)
    {
        $query = Enquiry::whereHas('enquiry_items', function ($q) use ($sellerCategoryIds) {
            $q->whereIn('category_id', $sellerCategoryIds);
        })->with(['user']);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('enquiry_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Apply time filter
        $timeFilter = $request->get('time_filter', '1_week');
        switch ($timeFilter) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case '1_week':
                $query->where('created_at', '>=', now()->subWeek());
                break;
            case '1_month':
                $query->where('created_at', '>=', now()->subMonth());
                break;
        }

        return $query;
    }
}
