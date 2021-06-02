<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'geolocation', 'meeting_point', 'description'
    ];

    public function happenings() {
        return $this->belongsToMany('App\Models\Happening', 'happenings', 'location_id');
    }
}

