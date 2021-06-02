<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HappeningType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public function happenings() {
        return $this->belongsToMany('App\Models\Happening', 'happening_type', 'type_id', 'happening_id');
    }
}
