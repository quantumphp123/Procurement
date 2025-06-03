<?php

namespace App\Listeners;

use App\Events\EnquirySubmitted;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HandleEnquirySubmission implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        Log::info('HandleEnquirySubmission Listener Constructed');
    }

    /**
     * Handle the event.
     */
    public function handle(EnquirySubmitted $event): void
    {
        try {
            $enquiry = $event->enquiry;

            Log::info('=== ENQUIRY SUBMISSION HANDLED ===', [
                'timestamp' => now()->toDateTimeString(),
                'enquiry_id' => $enquiry->id,
                'enquiry_number' => $enquiry->enquiry_number,
                'user_id' => $enquiry->user_id,
                'items_count' => $enquiry->items()->count(),
            ]);

            // Get all category IDs from enquiry items
            $enquiryCategoryIds = $enquiry->enquiry_items()->pluck('category_id')->unique()->toArray();

            Log::info('Enquiry Categories:', $enquiryCategoryIds);

            if (!empty($enquiryCategoryIds)) {
                // Find all sellers who have products in these categories
                $sellersWithMatchingCategories = User::where('role', 'seller') // Assuming you have role field
                    ->whereHas('products', function ($query) use ($enquiryCategoryIds) {
                        $query->whereIn('category_id', $enquiryCategoryIds);
                    })
                    ->pluck('id')
                    ->unique()
                    ->toArray();

                Log::info('Matching Sellers Found:', $sellersWithMatchingCategories);

                // Insert records in pivot table for each matching seller
                $pivotData = [];
                foreach ($sellersWithMatchingCategories as $sellerId) {
                    $pivotData[] = [
                        'enquiry_id' => $enquiry->id,
                        'seller_id' => $sellerId,
                        'status' => 'pending',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                if (!empty($pivotData)) {
                    // Insert all records at once for better performance
                    DB::table('enquiry_seller')->insert($pivotData);

                    Log::info('Enquiry assigned to sellers:', [
                        'enquiry_id' => $enquiry->id,
                        'sellers_count' => count($sellersWithMatchingCategories),
                        'seller_ids' => $sellersWithMatchingCategories
                    ]);
                } else {
                    Log::warning('No sellers found for enquiry categories', [
                        'enquiry_id' => $enquiry->id,
                        'categories' => $enquiryCategoryIds
                    ]);
                }
            }

        } catch (\Exception $e) {
            Log::error('Error in HandleEnquirySubmission: ' . $e->getMessage(), [
                'exception' => $e,
                'enquiry_id' => $event->enquiry->id ?? 'unknown'
            ]);
            throw $e; // Re-throw to ensure the job fails and can be retried
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(EnquirySubmitted $event, \Throwable $exception): void
    {
        Log::error('HandleEnquirySubmission Failed', [
            'enquiry_id' => $event->enquiry->id ?? 'unknown',
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}
