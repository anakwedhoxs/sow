<?php

namespace App\Filament\Resources\HostnameResource\Pages;

use App\Filament\Resources\HostnameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHostnames extends ListRecords
{
    protected static string $resource = HostnameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
