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
     * @var array
     */
    protected $fillable = [
        'name',
        'color'
    ];

    public function happenings() {
        return $this->belongsToMany('App\Models\Happening');
    }
}
