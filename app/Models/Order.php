<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_time',
        'expired',
        'user_id',
        'flag'
    ];
    protected $guarded = []; 

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function book_copy()
    {
        return $this->belongsToMany('App\Models\Book_User');
    }

    public function getOrdersExpired()
    {
        return Order::where("flag",0)->paginate(15);
    }
    
}
