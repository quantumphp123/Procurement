<?php

namespace App\Listeners;

use App\Events\EnquirySubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
                'memory_usage' => memory_get_usage(true) / 1024 / 1024 . 'MB'
            ]);

            // You can add more actions here, such as:
            // - Sending notifications
            // - Updating related records
            // - Triggering other processes

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