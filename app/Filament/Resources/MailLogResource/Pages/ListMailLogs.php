<?php

namespace App\Filament\Resources\MailLogResource\Pages;

use App\Filament\Resources\MailLogResource;
use App\Models\MailLog;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMailLogs extends ListRecords
{
    protected static string $resource = MailLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'seen' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_seen', true))->badge(MailLog::query()->where('is_seen', true)->count()),
            'unseen' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_seen', false)),
        ];
    }
}
