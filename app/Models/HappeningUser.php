<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HappeningUser extends Model
{
    protected $fillable = ['user_id', 'happening_id', 'application_status', 'user_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function happening()
    {
        return $this->belongsTo(Happening::class);
    }
}
