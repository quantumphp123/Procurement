<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
