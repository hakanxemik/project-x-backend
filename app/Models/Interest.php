<?php

namespace App\Models;

use App\Enums\InterestTypes;
use App\Enums\OfferingTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
