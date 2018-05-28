<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
