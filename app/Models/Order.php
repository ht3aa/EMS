<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Models\Interfaces\QueryBuilderInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model implements QueryBuilderInterface
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cart_id',
        'status',
    ];

    public function getAllowedFilters(): array
    {
        return [
            'status',
        ];
    }

    public function getAllowedSorts(): array
    {
        return [
            'status',
            'created_at',
            'updated_at',
        ];
    }

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
