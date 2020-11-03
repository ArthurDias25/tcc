<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function listings()
    {
        return $this->hasMany(Listing::class,'Id_Status','id');
    }
}
