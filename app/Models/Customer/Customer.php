<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Customer\VatDocument;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'phone',
        'address',
        'license_number',
        'contact_person_name',
        'contact_person_designation',
        'file_path',
        'plans',
        'user_id',
        'trial_starts_at',
        'trial_ends_at',
        'plan_expires_at',
        'is_trial_active'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'trial_starts_at' => 'datetime',
        'trial_ends_at' => 'datetime',
        'plan_expires_at' => 'datetime',
        'is_trial_active' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the VAT documents for the customer.
     */
    public function vatDocuments()
    {
        return $this->hasMany(VatDocument::class);
    }
}