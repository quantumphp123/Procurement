<?php

namespace App\Models\Customer;

use App\Models\Admin\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class EnquiryItem extends Model
{
    protected $fillable = [
        'enquiry_id',
        'user_id',
        'category_id',
        'item_description',
        'manufacturer',
        'qty',
        'unit_id',
        'remark',

    ];

    // Each item belongs to a single enquiry
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    // Each item belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optionally: category relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}