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
        'datetime',
        'max_guests',
        'price'
    ];

    public function users() {
        return $this->belongsToMany('App\Models\User')->withPivot('userType');
    }

    public function offerings() {
        return $this->belongsToMany('App\Models\Offering');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function type() {
        return $this->belongsTo('App\Models\HappeningType');
    }

    public function location() {
        return $this->belongsTo('App\Models\Location');
    }
}
