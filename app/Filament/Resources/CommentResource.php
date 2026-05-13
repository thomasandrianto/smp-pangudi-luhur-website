<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use App\Models\Post;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Komentar';
    protected static ?string $pluralModelLabel = 'Komentar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('post_id')
                ->label('Post')
                ->relationship('post', 'title')
                ->required(),

            TextInput::make('name')
                ->required(),

            TextInput::make('email')
                ->email(),

            Textarea::make('content')
                ->required(),

            Select::make('parent_id')
                ->label('Balasan dari')
                ->relationship('parent', 'content')
                ->searchable()
                ->placeholder('Tidak ada'),

            Toggle::make('is_approved')
                ->label('Disetujui'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->headerActions([])
            ->columns([
                TextColumn::make('nomor')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('post.title')
                    ->label('Post')
                    ->limit(20),

                TextColumn::make('name')
                    ->label('Nama'),

                TextColumn::make('content')
                    ->label('Komentar')
                    ->limit(40),

                TextColumn::make('parent.content')
                    ->label('Reply ke')
                    ->limit(20),

                TextColumn::make('is_approved')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Approved' : 'Pending'),

                TextColumn::make('created_at')
                    ->dateTime('d-m-Y H:i'),
            ])
            ->actions([
                // ✅ Approve cepat
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(fn ($record) => $record->update([
                        'is_approved' => true,
                    ]))
                    ->visible(fn ($record) => !$record->is_approved),

                // 🔁 Reply admin
                Tables\Actions\Action::make('reply')
                    ->label('Reply')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->form([
                        Textarea::make('content')
                            ->label('Balasan')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        Comment::create([
                            'post_id' => $record->post_id,
                            'name' => 'Admin',
                            'email' => 'admin@site.com',
                            'content' => $data['content'],
                            'parent_id' => $record->id,
                            'is_approved' => true,
                        ]);
                    }),

                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('Belum ada komentar')
            ->emptyStateDescription('Komentar dari user akan tampil di sini.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
        ];
    }
}