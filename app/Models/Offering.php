<?php

namespace App\Models;

use App\Enums\OfferingTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function happenings() {
        return $this->belongsToMany('App\Models\Happening');
    }
}
