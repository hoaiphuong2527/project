<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_User extends Model
{
    protected $table = 'book_user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'book_id',
    ];
    protected $guarded = []; 

    public function order()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function countBook($id)
    {
        return Book_User::where('book_id', $id)->where('flag',0)->count();
    }

    public function getItemFlagIsFalse()
    {
        return Book_User::select("book_id")->where('flag',0)->distinct()->get();
    }

}
