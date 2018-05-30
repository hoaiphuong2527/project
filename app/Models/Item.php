<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'book_copy_id'
    ];
    protected $guarded = []; 

    
    public function getItemById($order_id)
    {
        return Item::where('order_id',$order_id)->get();
    }
}
