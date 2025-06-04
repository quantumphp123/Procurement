<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'enquiry_number',
        'drafted'
    ];

    protected $dates = ['deleted_at'];

    public function items()
    {
        return $this->hasMany(EnquiryItem::class);
    }
}