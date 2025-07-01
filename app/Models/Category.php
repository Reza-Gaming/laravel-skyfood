<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'icon'];

    public function foods()
    {
        return $this->hasMany(\App\Models\Food::class);
    }
}
