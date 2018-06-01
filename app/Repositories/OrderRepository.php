<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order) 
    {
        $this->model = $order;
    }

}