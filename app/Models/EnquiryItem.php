<?php
namespace App\Models;

use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnquiryItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'enquiry_id',
        'category_id',
        'item_description',
        'manufacturer',
        'quantity',
        'remark',
        'delivery_date',
    ];

    protected $dates = ['delivery_date', 'deleted_at'];

    // Relationship with Enquiry
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}


