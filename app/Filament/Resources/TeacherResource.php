<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Teacher;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class TeacherResource extends Resource
{   
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Guru';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 22;

    protected static ?string $modelLabel = 'Guru';
    protected static ?string $pluralModelLabel = 'Data Guru';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nip')
                    ->label('NIP')
                    ->maxLength(30)
                    ->unique(ignoreRecord: true),

                TextInput::make('name')
                    ->label('Nama Guru')
                    ->required()
                    ->maxLength(100),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->placeholder('Pilih jenis kelamin'),

                TextInput::make('subject')
                    ->label('Mata Pelajaran')
                    ->maxLength(120),

                TextInput::make('place_of_birth')
                    ->label('Tempat Lahir'),

                DatePicker::make('date_of_birth')
                    ->label('Tanggal Lahir'),

                FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->directory('teachers'),
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
                    ->label('Tambah Guru')
                    ->slideOver()
                    ->modalWidth('lg'),
            ])
            ->columns([
                TextColumn::make('nomor')
                    ->label('No')
                    ->rowIndex(),

                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),

                TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('subject')
                    ->label('Mapel'),

                TextColumn::make('gender')
                    ->label('JK'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d-m-Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->slideOver(),

                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('Belum ada data guru')
            ->emptyStateDescription('Silakan tambahkan data guru pertama.')
            ->emptyStateIcon('heroicon-o-user');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
        ];
    }
}