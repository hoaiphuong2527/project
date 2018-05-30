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
        'name',
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
        return $this->hasMany('App\Models\Orders');
    }

    public function books()
    {
        return $this->hasMany('App\Models\BookItem', '');
    }
    
    public static function boot() {
        parent::boot();
    }
}
