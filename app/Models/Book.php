<?php

namespace App\Models;

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
        return $this->belongsToMany('App\Models\User');
    }

    public function order()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    
}
