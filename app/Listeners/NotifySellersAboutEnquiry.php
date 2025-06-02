<?php

namespace App\Listeners;

use App\Events\EnquiryCreated;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotifySellersAboutEnquiry
{
    public function handle(EnquiryCreated $event)
    {
        try {
            $enquiry = $event->enquiry;

            // Get Enquiry items categories
            $categoryIds = $enquiry->enquiry_items()->pluck('category_id')->unique();

            if ($categoryIds->isEmpty()) {
                Log::info('No categories found for enquiry: ' . $enquiry->id);
                return;
            }

            // Find Matching sellers
            $matchingSellers = User::where('role', 'seller')
                ->where('status', 1) // Active sellers only
                ->whereHas('products', function($query) use ($categoryIds) {
                    $query->whereIn('category_id', $categoryIds);
                })
                ->get();

            // Store Each seller in enquiry_seller table
            foreach ($matchingSellers as $seller) {
                DB::table('enquiry_seller')->updateOrInsert(
                    [
                        'enquiry_id' => $enquiry->id,
                        'seller_id' => $seller->id
                    ],
                    [
                        'status' => 'pending',
                        'notified_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }

            Log::info('Notified ' . $matchingSellers->count() . ' sellers for enquiry: ' . $enquiry->id);

        } catch (\Exception $e) {
            Log::error('Error notifying sellers: ' . $e->getMessage());
        }
    }
}
