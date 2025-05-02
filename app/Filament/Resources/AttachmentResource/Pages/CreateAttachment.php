<?php

namespace App\Filament\Resources\AttachmentResource\Pages;

use App\Filament\Resources\AttachmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttachment extends CreateRecord
{
    protected static string $resource = AttachmentResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     dd($data);
    //     $data['user_id'];

    //     return $data;
    // }
}
