<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MailLogResource\Pages;
use App\Filament\Resources\MailLogResource\RelationManagers;
use App\Models\MailLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MailLogResource extends Resource
{
    protected static ?string $model = MailLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('campaign.subject'),
                TextColumn::make('campaign.attachment.name'),
                TextColumn::make('lead.email'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])->modifyQueryUsing(
                fn(Builder $query) => $query->latest()
            )
        ;
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
            'index' => Pages\ListMailLogs::route('/'),
            'create' => Pages\CreateMailLog::route('/create'),
            'edit' => Pages\EditMailLog::route('/{record}/edit'),
        ];
    }
}
