<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttachmentResource\Pages;
use App\Filament\Resources\AttachmentResource\RelationManagers;
use App\Models\Attachment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;

class AttachmentResource extends Resource
{
    protected static ?string $model = Attachment::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('path')->columnSpanFull()->acceptedFileTypes(['application/pdf'])->label('Attachment')->storeFileNamesIn('name')->validationAttribute('Attachment')->maxSize(1024 * 25)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListAttachments::route('/'),
            'create' => Pages\CreateAttachment::route('/create'),
            'edit' => Pages\EditAttachment::route('/{record}/edit'),
        ];
    }
}
