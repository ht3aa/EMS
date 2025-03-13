<?php

namespace App\Traits;

trait HasRedirectToIndexPage
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
