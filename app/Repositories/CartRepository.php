<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Cart::class);
    }
}
