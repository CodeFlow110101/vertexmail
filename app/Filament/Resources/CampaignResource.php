<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Filament\Resources\CampaignResource\RelationManagers;
use App\Models\Attachment;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Set;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Select;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->placeholder('Name'),
                TextInput::make('subject')->live()->required()->placeholder('Subject')->columnSpanFull(),
                RichEditor::make('template')->live()->required()->columnSpanFull(2),
                Select::make('attachment_id')
                    ->label('Attachment')
                    ->options(Attachment::all()->pluck('name', 'id'))
                    ->searchable()->columnSpanFull(),
                Textarea::make('emails')->live()->afterStateUpdated(function (Set $set, $state) {
                    $set(
                        'emails_preview',
                        collect(explode(',', $state))->map(fn($email) => trim($email))->unique()->filter(fn($email) => preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email))->map(fn($email) => ['email' => $email])->all()
                    );
                })->columnSpanFull(),
                Section::make('Emails Retrived')->schema([
                    Repeater::make('emails_preview')->simple(TextInput::make('email')->readOnly())->addable(false)->deletable(false)->reorderable(false)->defaultItems(0)->grid(2)->label('')->required()->validationAttribute('Email(s)')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('subject'),
                TextColumn::make('attachment.name'),
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
           ->modifyQueryUsing(
                fn(Builder $query) => $query->latest()
            );
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
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
