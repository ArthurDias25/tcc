<?php

namespace App;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function follower(){
        return $this->hasMany(User::class,'Follower','id');
    }
    public function following()
    {
        return $this->hasMany(User::class,'Following','id');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class,'Id_Usuario','id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'Id_Usuario','id');
    }

    public function postlikes()
    {
        return $this->hasMany(PostLike::class,'Id_Usuario','id');
    }

}
