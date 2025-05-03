<?php

namespace App\Listeners;

use App\Events\MailCreated;
use App\Models\MailLog;
use App\Notifications\SendMail;
use Filament\Notifications\Notification;
use Illuminate\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class MailEventSubscriber implements ShouldQueue
{

    public function handleCreate(MailCreated $event): void
    {
        MailLog::find($event->mail)->lead->notify(new SendMail($event->mail));
    }


    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            MailCreated::class,
            [MailEventSubscriber::class, 'handleCreate']
        );
    }
}
