<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class UserBookItem extends BaseModel
{
    protected $table = 'user_book_items';


    protected $fillable = [
        'user_id',
        'book_item_id'
    ];
    
    protected $guarded = []; 
}
