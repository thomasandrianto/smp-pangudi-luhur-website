<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Post';
    protected static ?string $pluralModelLabel = 'Post';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Judul')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(
                    fn (string $state, callable $set) =>
                        $set('slug', Str::slug($state))
                ),

            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->maxLength(255)
                ->alphaDash()
                ->unique(ignoreRecord: true),

            Select::make('category_id')
                ->label('Kategori')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

            FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->disk('public')
                ->directory('posts')
                ->image()
                ->imageEditor()
                ->imagePreviewHeight('150')
                ->acceptedFileTypes([
                    'image/jpeg',
                    'image/png',
                    'image/webp',
                ])
                ->maxSize(2048) // 2 MB
                ->preserveFilenames(false)
                ->nullable(),

            RichEditor::make('content')
                ->label('Konten')
                ->required()
                ->maxLength(100000)
                ->columnSpanFull(),

            Toggle::make('is_published')
                ->label('Publish')
                ->default(false)
                ->live(),

            DateTimePicker::make('published_at')
                ->label('Tanggal Publish')
                ->seconds(false)
                ->hidden(fn (callable $get): bool => ! $get('is_published'))
                ->required(fn (callable $get): bool => $get('is_published'))
                ->default(now()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Post')
                    ->slideOver()
                    ->modalWidth('7xl')
                    ->mutateFormDataUsing(fn (array $data): array => static::prepareData($data)),
            ])
            ->columns([
                TextColumn::make('nomor')
                    ->rowIndex(),

                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->size(50)
                    ->square(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge(),

                TextColumn::make('is_published')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn (bool $state): string =>
                            $state ? 'Publish' : 'Draft'
                    )
                    ->color(
                        fn (bool $state): string =>
                            $state ? 'success' : 'gray'
                    ),

                TextColumn::make('views')
                    ->label('Views')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->slideOver()
                    ->modalWidth('7xl')
                    ->mutateFormDataUsing(fn (array $data): array => static::prepareData($data)),

                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ]);
    }

    /**
     * Normalize and secure data before saving.
     */
    protected static function prepareData(array $data): array
    {
        $data['title'] = trim($data['title']);
        $data['slug'] = Str::slug($data['slug']);
        $data['content'] = trim($data['content']);

        if (($data['is_published'] ?? false) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if (! ($data['is_published'] ?? false)) {
            $data['published_at'] = null;
        }

        return $data;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
        ];
    }
}