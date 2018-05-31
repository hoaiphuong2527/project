<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Book extends BaseModel
{
    protected $table = 'books';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'type'
    ];
    
    protected $guarded = []; 

    public function bookItems() {
        return $this->hasMany('App\Models\BookItem', 'book_id', 'id');
    }
}
