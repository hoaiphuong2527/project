<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'book_id'
    ];
    protected $guarded = []; 
}
