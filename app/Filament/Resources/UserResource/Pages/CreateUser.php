<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Traits\HasRedirectToIndexPage;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use HasRedirectToIndexPage;

    protected static string $resource = UserResource::class;
}
