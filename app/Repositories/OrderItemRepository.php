<?php

namespace App\Repositories;

use App\Models\OrderItem;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class OrderItemRepository extends BaseRepository
{
    public function __construct(OrderItem $order_item) 
    {
        $this->model = $order_item;
    }

}