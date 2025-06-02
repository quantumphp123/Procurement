<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'bank_name',
        'ifsc_code',
        'bank_account_number',
        'account_holder_name',
        'branch_location',
        'bank_info_completed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bank_info_completed' => 'boolean',
    ];

    /**
     * Get the user that owns the bank details.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
