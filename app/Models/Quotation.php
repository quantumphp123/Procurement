<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'enquiry_id',
        'user_id',
        'quotation_number',
        'delivery_date',
        'total_price',
        'discount_percentage',
        'discounted_price',
        'vat_percentage',
        'final_price',
        'status'
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'total_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'vat_percentage' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    // Relationships
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    // Generate quotation number
    public static function generateQuotationNumber()
    {
        $lastQuotation = self::orderBy('id', 'desc')->first();
        $lastNumber = $lastQuotation ? intval(substr($lastQuotation->quotation_number, 3)) : 0;
        return 'QUO' . str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);
    }
}
