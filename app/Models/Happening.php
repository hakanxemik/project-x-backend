<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Happening extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'offeringsDescription',
        'datetime',
        'maxGuests',
        'price'
    ];

    public function users() {
        return $this->belongsToMany('App\Models\User')->as('attendance')->withPivot('userType');
    }

    public function offerings() {
        return $this->belongsToMany('App\Models\Offering');
    }

    public function category() {
        return $this->belongsToMany('App\Models\Category');
    }

    public function type() {
        return $this->belongsToMany('App\Models\Type');
    }

    public function location() {
        return $this->belongsTo('App\Models\Location');
    }
}
