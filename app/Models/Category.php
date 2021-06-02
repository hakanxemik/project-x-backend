<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'color'
    ];

    public function happenings() {
        return $this->belongsToMany('App\Models\Happening', 'happening_category', 'category_id', 'happening_id');
    }
}
