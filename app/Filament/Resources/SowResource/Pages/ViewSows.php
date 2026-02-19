<?php

namespace App\Filament\Resources\SOWResource\Pages;

use App\Filament\Resources\SOWResource;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Inventaris;

class ViewSOW extends ViewRecord
{
    protected static string $resource = SOWResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (!empty($data['inventaris_id'])) {
            $inventaris = Inventaris::find($data['inventaris_id']);

            if ($inventaris) {
                $data['hardware_view'] = $inventaris->Kategori;
                $data['merk_view'] = $inventaris->Merk;
                $data['seri_view'] = $inventaris->Seri;
            }
        }

        return $data;
    }
}
