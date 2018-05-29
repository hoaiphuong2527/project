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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function book()
    {
        return $this->belongsToMany('App\Models\Book');
    }
}
