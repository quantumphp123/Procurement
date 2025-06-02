<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'user_id',
        'enquiry_number',
        
    ];

    public function items()
    {
        return $this->hasMany(EnquiryItem::class);
    }
}