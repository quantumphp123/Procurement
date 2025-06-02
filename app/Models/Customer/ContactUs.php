<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contact_us';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'message',
        'privacy_policy_accepted'
    ];

    protected $casts = [
        'privacy_policy_accepted' => 'boolean',
    ];

    /**
     * Get the user that owns the contact message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
