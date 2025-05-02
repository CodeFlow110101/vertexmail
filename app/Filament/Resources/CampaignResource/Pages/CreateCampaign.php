<?php

namespace App\Filament\Resources\CampaignResource\Pages;

use App\Filament\Resources\CampaignResource;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\MailLog;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Log;

class CreateCampaign extends CreateRecord
{
    protected static string $resource = CampaignResource::class;

    protected function getFormActions(): array
    {
        return [
            ...parent::getFormActions(),
            Action::make('Send Test Mail')->form([
                Select::make('email')
                    ->label('Select Email')
                    ->options(Lead::all()->pluck('email', 'email'))
                    ->searchable()->required(),
            ])->action(function (array $data): void {
                $campaign = Campaign::create([
                    'name' => 'Test Campaign',
                    'template' => $this->data['template'],
                    'subject' => $this->data['subject'],
                    'attachment_id' => $this->data['attachment_id'],
                ]);

                collect($data['email'])->map(function (string $email) {
                    return Lead::firstOrCreate([
                        'email' => $email
                    ]);
                })->each(function (Lead $lead) use ($campaign) {
                    MailLog::create([
                        'campaign_id' => $campaign->id,
                        'lead_id' => $lead->id
                    ]);
                });
            })->disabled($this->data['template'] && $this->data['subject'] ? false : true),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $campaign = Campaign::create([
            'name' => $data['name'],
            'template' => $data['template'],
            'subject' => $data['subject'],
            'attachment_id' => $this->data['attachment_id'],
        ]);

        collect($data['emails_preview'])->map(function (string $email) {
            return Lead::firstOrCreate([
                'email' => $email
            ]);
        })->each(function (Lead $lead) use ($campaign) {
            MailLog::create([
                'campaign_id' => $campaign->id,
                'lead_id' => $lead->id
            ]);
        });

        return $campaign;
    }
}
