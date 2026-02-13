<?php

namespace App\Filament\Resources\DokumentasiArsipResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DokumentasiArsipExport;
use Carbon\Carbon;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $title = 'Item Dokumentasi';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang')
                    ->label('Nama Barang')
                    ->wrap()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->height(80)
                    ->extraImgAttributes([
                        'style' => 'object-fit: cover;',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),

                Action::make('export')
                ->label('Export Dokumentasi Arsip')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {

                    $tanggal = now()->format('d-m-Y');
                    $namaFile = "dokumentasi_arsip_{$tanggal}.xlsx";

                    return Excel::download(
                        new DokumentasiArsipExport($this->ownerRecord->id),
                        $namaFile
                    );
                }),

            ])
            ->actions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->form([
                        Forms\Components\TextInput::make('nama_barang')
                            ->label('Nama Barang')
                            ->disabled()
                            ->default(fn ($record) => $record->nama_barang),

                        Forms\Components\Placeholder::make('foto_preview')
                            ->label('Foto')
                            ->content(fn ($record) => $record->foto ? view('filament.image_preview', ['src' => asset('storage/' . $record->foto)]) : 'Tidak ada foto')
                            ->columnSpan('full'),
                    ])
                    ->modalHeading('View dokumentasi arsip item')
                    ->modalWidth('xl')
                    ->modalActions([]),

                Tables\Actions\EditAction::make(),
                Action::make('download')
                    ->label('Download Foto')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => $record->foto ? route('dokumentasi-arsip-item.download', $record) : null)
                    ->openUrlInNewTab(true)
                    ->visible(fn ($record) => ! empty($record->foto)),
            ])
            ->paginated(false);
    }
}
