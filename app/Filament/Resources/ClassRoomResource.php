<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassRoomResource\Pages;
use App\Models\ClassRoom;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ClassRoomResource extends Resource
{
    protected static ?string $model = ClassRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Kelas';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 20;

    protected static ?string $modelLabel = 'Kelas';
    protected static ?string $pluralModelLabel = 'Data Kelas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Kelas')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('Contoh: X RPL 1')
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'required' => 'Nama kelas wajib diisi.',
                        'unique' => 'Nama kelas sudah ada.',
                    ])
                    ->autofocus(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('name')
            ->paginated([10, 25, 50, 100])
            ->defaultPaginationPageOption(25)
            ->searchDebounce('500ms')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Kelas')
                    ->slideOver()
                    ->modalWidth('lg'),
            ])
            ->columns([
                TextColumn::make('nomor')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('name')
                    ->label('Nama Kelas')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->slideOver()
                    ->modalWidth('lg'),

                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('Belum ada data kelas')
            ->emptyStateDescription('Silakan tambahkan data kelas pertama.')
            ->emptyStateIcon('heroicon-o-academic-cap');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassRooms::route('/'),
        ];
    }
}