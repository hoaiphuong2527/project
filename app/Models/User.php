<?php

namespace App\Models;

use App\Events\ModelObserver;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'user_role',
        'remember_token'
    ];
    protected $guarded = []; 

    // public function username()
    // {
    //     return 'username';
    // }

    public function orders()
    {
        return $this->hasMany('App\Models\Orders','borrower_id');
    }

    public function books()
    {
        return $this->hasMany('App\Models\BookItem');
    }
    
    public function socials()
    {
        return $this->hasMany('App\Models\SocialAccount');
    }

    public function user_book_items()
    {
        return $this->hasMany('App\Models\UserBookItem','user_id','id');
    }

    public static function boot() {
        parent::boot();
    }
}
