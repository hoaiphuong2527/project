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

    public function getAll()
    {
        return User::all();
    }

    public function findUser($id)
    {
        return User::find((int) $id);
    }

    public function destroyUser($id)
	{
		$user = User::find((int) $id);
        $user->delete();
    }
    
    public function book()
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('flag');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Oders');
    }
    

    public static function boot() {
        parent::boot();
    }
	
}
