<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','category_id',];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}