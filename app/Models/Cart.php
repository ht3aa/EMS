<?php

namespace App\Models;

use App\Models\Interfaces\QueryBuilderInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model implements QueryBuilderInterface
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function getAllowedFilters(): array
    {
        return [
            'user_id',
            'product_id',
            'quantity',
        ];
    }

    public function getAllowedSorts(): array
    {
        return [
            'user_id',
            'product_id',
            'quantity',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
