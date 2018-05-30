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
}
