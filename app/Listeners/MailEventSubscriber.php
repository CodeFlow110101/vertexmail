<?php

namespace App\Listeners;

use App\Events\MailCreated;
use App\Notifications\SendMail;
use Filament\Notifications\Notification;
use Illuminate\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailEventSubscriber
{

    public function handleCreate(MailCreated $event): void
    {
        $event->mail->lead->notify(new SendMail($event));
    }


    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            MailCreated::class,
            [MailEventSubscriber::class, 'handleCreate']
        );
    }
}
