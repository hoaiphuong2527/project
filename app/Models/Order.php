<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Order extends BaseModel
{
    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = [
        'expired_date',
        'borrower_id'
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
}
