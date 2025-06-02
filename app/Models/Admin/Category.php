<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'title',
        'description',
    ];

    protected $dates = ['deleted_at'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
