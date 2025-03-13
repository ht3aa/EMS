<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Traits\HasRedirectToIndexPage;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    use HasRedirectToIndexPage;

    protected static string $resource = ProductResource::class;
}
