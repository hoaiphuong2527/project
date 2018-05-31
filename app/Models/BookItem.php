<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class BookItem extends BaseModel
{
    protected $table = 'book_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'book_id'
    ];
    protected $guarded = []; 

    public function book()
    {
        return $this->belongsTo('App\Models\Book', 'book_id');
    }

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem', 'book_item_id', 'id');
    }

    public function countBookById($id)
    {
        return BookItem::where('book_id',$id)->count();
    }
    
}
