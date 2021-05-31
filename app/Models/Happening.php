<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Happening extends Model
{
    protected $fillable = [
        'title', 'date', 'location',
        'category', 'offerings', 'max_guests', 'price'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User', 'happening_user', 'happening_id', 'user_id', )->withPivot('application_status', 'user_type');
    }

    use HasFactory;
}
