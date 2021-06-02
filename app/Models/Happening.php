<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Happening extends Model
{
    protected $fillable = [
        'title', 'date', 'max_guests', 'price'
    ];

    public function users() {
        return $this->belongsToMany('App\Models\User', 'happening_user', 'happening_id', 'user_id', )
                    ->withPivot('application_status', 'user_type');
    }

    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'happening_category', 'happening_id', 'category_id', );
    }

    public function offerings() {
        return $this->belongsToMany('App\Models\Offering', 'happening_offering', 'happening_id', 'offering_id', );
    }

    public function location() {
        return $this->belongsTo('App\Models\Location', 'location_id');
    }

    public function types() {
        return $this->belongsToMany('App\Models\HappeningType', 'happening_type', 'happening_id', 'type_id');
    }

    use HasFactory;
}
