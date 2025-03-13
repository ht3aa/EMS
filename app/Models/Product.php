<?php

namespace App\Models;

use App\Models\Interfaces\QueryBuilderInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements QueryBuilderInterface
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];

    public function getAllowedFilters(): array
    {
        return [
            'name',
            'price',
            'stock',
        ];
    }

    public function getAllowedSorts(): array
    {
        return [
            'name',
            'price',
            'stock',
        ];
    }
}
