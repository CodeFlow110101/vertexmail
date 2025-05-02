<?php

namespace App\Mail;

use App\Models\MailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LeadMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $maillog;

    public function __construct($maillog)
    {
        $this->maillog = $maillog->mail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->maillog->campaign->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.lead-mail',
            with: [
                'template' => $this->maillog->campaign->template,
                'id' => $this->maillog->id
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('public', $this->maillog->campaign->attachment->path)
                ->as($this->maillog->campaign->attachment->name)
                ->withMime('application/pdf'),
        ];
    }
}
