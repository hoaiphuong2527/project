<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Order extends BaseModel
{
    protected $table = 'orders';
    public static $snakeAttributes = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'expired_date',
        'borrower_id',
        'return_date',
        'status'
    ];
    protected $guarded = []; 

    public function borrower()
    {
        return $this->belongsTo('App\Models\User', 'borrower_id');
    }

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }

    public function getOrders($search_query)
    {
        return $search_query->paginate(15);
    }

    /**
     * Get expired order
     * @param $expired_date
     */
    public function scopeExpiredOrder($query, $expired_date)
    {
        return $query->where('expired_date', '<', $expired_date)->whereNull('return_date');
    }
    
}
