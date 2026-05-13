<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use App\Models\ClassRoom;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class StudentResource extends Resource
{    
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Siswa';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 21;

    protected static ?string $modelLabel = 'Siswa';
    protected static ?string $pluralModelLabel = 'Data Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nis')
                    ->label('NIS')
                    ->required()
                    ->maxLength(30)
                    ->unique(ignoreRecord: true),

                TextInput::make('name')
                    ->label('Nama Siswa')
                    ->required()
                    ->maxLength(100),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->placeholder('Pilih jenis kelamin'),

                Select::make('class_room_id')
                    ->label('Kelas')
                    ->relationship('classRoom', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->directory('students')
                    ->nullable(),
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
                    ->label('Tambah Siswa')
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

                TextColumn::make('nis')
                    ->label('NIS')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('classRoom.name')
                    ->label('Kelas')
                    ->sortable(),

                TextColumn::make('gender')
                    ->label('JK')
                    ->formatStateUsing(fn ($state) => $state === 'L' ? 'L' : 'P'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d-m-Y H:i')
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
            ->emptyStateHeading('Belum ada data siswa')
            ->emptyStateDescription('Silakan tambahkan data siswa pertama.')
            ->emptyStateIcon('heroicon-o-user-group');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
        ];
    }
}