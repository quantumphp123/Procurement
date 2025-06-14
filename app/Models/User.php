<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Customer\Customer;
use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the seller profile associated with the user.
     */
    public function sellerProfile(): HasOne
    {
        return $this->hasOne(SellerProfile::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Get the bank details associated with the user.
     */
    public function bankDetail(): HasOne
    {
        return $this->hasOne(BankDetail::class);
    }

    /**
     * Check if the user is a seller.
     */
    public function isSeller(): bool
    {
        return $this->role_id === 3;
    }

    /**
     * Check if the user has completed business information.
     */
    public function hasCompletedBusinessInfo(): bool
    {
        return $this->sellerProfile && $this->sellerProfile->business_info_completed;
    }

    /**
     * Check if the user has completed bank information.
     */
    public function hasCompletedBankInfo(): bool
    {
        return $this->bankDetail && $this->bankDetail->bank_info_completed;
    }

    /**
     * Check if the user has completed all registration steps.
     */
    public function hasCompletedAllSteps(): bool
    {
        if (!$this->isSeller()) {
            return true; // Non-sellers don't need to complete business and bank info
        }

        return $this->hasCompletedBusinessInfo() && $this->hasCompletedBankInfo();
    }

    public function enquiries()
    {
        return $this->belongsToMany(Enquiry::class, 'enquiry_seller')
            ->withPivot('status', 'responded_at')
            ->withTimestamps();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function notifiedEnquiries()
    {
        return $this->belongsToMany(Enquiry::class, 'enquiry_seller', 'seller_id', 'enquiry_id')
            ->withPivot('status', 'notified_at', 'responded_at')
            ->withTimestamps();
    }
}
