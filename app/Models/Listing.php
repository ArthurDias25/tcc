<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    public function status()
    {
        return $this->belongsTo(Status::class,'Id_Status','id');
    }
}
