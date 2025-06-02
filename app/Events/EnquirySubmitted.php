<?php

namespace App\Events;

use App\Models\Customer\Enquiry;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EnquirySubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $enquiry;

    /**
     * Create a new event instance.
     */
    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
        Log::info('EnquirySubmitted Event Fired', [
            'enquiry_id' => $enquiry->id,
            'enquiry_number' => $enquiry->enquiry_number,
            'timestamp' => now()->toDateTimeString()
        ]);
    }
} 