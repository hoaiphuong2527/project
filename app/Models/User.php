<?php

namespace App\Models;

use App\Events\ModelObserver;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;

class User extends Model
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
    
    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    public static function boot() {
        parent::boot();
        User::observe(new ModelObserver());
    }
	
}
