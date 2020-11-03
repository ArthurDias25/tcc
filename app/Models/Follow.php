<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'Follower', 'Following'
    ];

    public function follower(){
        return $this->belongsTo(User::class,'Follower','id');
    }
    public function following()
    {
        return $this->belongsTo(User::class,'Following','id');
    }
}
