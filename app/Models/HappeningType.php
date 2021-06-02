<?php

namespace App\Models;

use App\Enums\HappeningTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HappeningType extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => HappeningTypes::class
    ];

    public function happenings() {
        return $this->hasMany('App\Models\Happening');
    }
}
