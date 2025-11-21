<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriResource\Pages;
use App\Models\Galeri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Galeri';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        TextInput::make('judul')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        FileUpload::make('gambar')
                            ->label('Foto Galeri')
                            ->required()
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->minFiles(1)
                            ->maxFiles(15)
                            ->downloadable()
                            ->previewable(true)
                            ->disk('public')
                            ->directory('galeri')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(2048)
                            ->panelLayout('grid')
                            ->columnSpanFull(),
                        RichEditor::make('deskripsi_singkat')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                ImageColumn::make('cover_image')
                    ->label('Preview')
                    ->disk('public')
                    ->width(80)
                    ->height(80)
                    ->square()
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->url(fn($record) => $record?->cover_image ? ('/storage/' . $record->cover_image) : null),
                TextColumn::make('gambar_count')
                    ->label('Jumlah Foto')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state . ' foto'),
                TextColumn::make('deskripsi_singkat')
                    ->label('Deskripsi')
                    ->formatStateUsing(fn($state) => \Illuminate\Support\Str::limit(strip_tags($state ?? ''), 50))
                    ->wrap(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleris::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'edit' => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}
