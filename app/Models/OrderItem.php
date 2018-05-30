<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends BaseModel
{
    protected $table = 'order_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'book_item_id'
    ];
    protected $guarded = [];

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function bookItem() {
        return $this->belongsTo('App\Models\BookItem', 'book_item_id');
    }
}
