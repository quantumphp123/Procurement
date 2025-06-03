<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'enquiry_number',
        'user_id',
        'contact_number',
    ];

    protected $dates = ['deleted_at'];

    // Relationship with User (Customer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Enquiry Items
    public function enquiry_items()
    {
        return $this->hasMany(EnquiryItem::class);
    }

    // Many-to-Many relationship with Sellers through pivot table
    public function sellers()
    {
        return $this->belongsToMany(User::class, 'enquiry_seller', 'enquiry_id', 'seller_id')
                    ->withPivot('status', 'responded_at')
                    ->withTimestamps();
    }

    // Get sellers for specific status
    public function getSellersWithStatus($status)
    {
        return $this->sellers()->wherePivot('status', $status)->get();
    }

    // Check if enquiry is assigned to specific seller
    public function isAssignedToSeller($sellerId)
    {
        return $this->sellers()->where('seller_id', $sellerId)->exists();
    }
}
