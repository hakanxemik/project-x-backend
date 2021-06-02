<?php

namespace App\Models;

use App\Enums\CategoryColors;
use App\Enums\CategoryTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => CategoryTypes::class,
        'color' => CategoryColors::class
    ];

    public function happenings() {
        return $this->hasMany('App\Models\Happening');
    }
}
