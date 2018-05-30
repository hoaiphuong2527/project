<?php

namespace App\Models;

use App\Models\Book_User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'type',
        'amount',
    ];
    protected $guarded = []; 


    public function findBook($id)
    {
        return Book::find((int) $id);
    }

    public function destroyBook($id)
	{
		$obj = Book::find((int) $id);
        $obj->delete();
    }

    public function user()
    {
        return $this->belongsToMany('App\Models\User')->withPivot('flag');
        ;
    }


    public function getBookByFlag()
    {
        $obj = new Book_User();

       return $list_obj_flag_false = $obj->getItemFlagIsFalse();

    }

    
}
