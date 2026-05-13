<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Agenda';
    protected static ?string $pluralModelLabel = 'Agenda';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Judul Agenda')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(4),

            DatePicker::make('start_date')
                ->label('Tanggal Mulai'),

            DatePicker::make('end_date')
                ->label('Tanggal Selesai'),

            TextInput::make('time_text')
                ->label('Waktu (Text)')
                ->placeholder('Contoh: 08:00 - 12:00 WIB'),

            TextInput::make('location')
                ->label('Tempat'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('start_date', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Agenda')
                    ->slideOver()
                    ->modalWidth('4xl')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['created_by'] = auth()->id();
                        return $data;
                    }),
            ])
            ->columns([
                TextColumn::make('nomor')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d-m-Y'),

                TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date('d-m-Y'),

                TextColumn::make('location')
                    ->label('Tempat')
                    ->limit(30),

                TextColumn::make('time_text')
                    ->label('Waktu'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d-m-Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->slideOver()
                    ->modalWidth('4xl'),

                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('Belum ada agenda')
            ->emptyStateDescription('Silakan tambahkan agenda pertama.')
            ->emptyStateIcon('heroicon-o-calendar-days');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
        ];
    }
}