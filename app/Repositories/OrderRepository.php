<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;

class OrderRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Order::class);
    }
}
