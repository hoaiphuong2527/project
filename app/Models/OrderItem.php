<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\BookItem;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends BaseModel
{
    protected $table = 'order_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'book_item_id',
        'status'
    ];
    protected $guarded = [];

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function bookItem() {
        return $this->belongsTo('App\Models\BookItem', 'book_item_id');
    }

    public function deleteItemByOrderID($id)
    {
        $objs = OrderItem::where('order_id',$id)->get();
        foreach ($objs as $obj) {
            $book_item = BookItem::find((int) $obj->book_item_id);
            $book_item->status = 0;
            $book_item->save();
            $obj->delete();
        }
    }

    public function getItemByOrderID($id)
    {
        return OrderItem::where('order_id',$id)->get();
    }

    public function bookItemIsExist($id)
    {
        $flag = false;
        $item =  OrderItem::where('book_item_id',$id)->first();
        if($item != null)
            $flag = true;
        return $flag;   
    }

    public function deleteItem($id)
    {
        $items = OrderItem::where('order_id',$id)->get();
        foreach($items as $item){
            $item->delete();
        }
    }
}
