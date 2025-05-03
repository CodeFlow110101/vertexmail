<?php

namespace App\Listeners;

use App\Events\MailSeen;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSeen as MailSeenMail;


class SendMailSeenNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MailSeen $event): void
    {
        Mail::to(env('ADMIN_MAIL'))->send(new MailSeenMail($event->maillog));
    }
}
