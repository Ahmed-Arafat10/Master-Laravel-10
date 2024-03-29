## Mails In Laravel

- In `.env` file:
````php
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465|587
MAIL_USERNAME=YourMail
MAIL_PASSWORD=YourPassword
MAIL_ENCRYPTION=ssl|tls
MAIL_FROM_ADDRESS=YourMail
MAIL_FROM_NAME="${APP_NAME}"
````

- Create new mail class
````php
php artisan make:mail welcome
````

- In `app` > `Mail` > `welcome.php` :
````php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class welcome extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'This Is The Email Subject',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'AhmedArafat',
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
            Attachment::fromPath('storage/IMG/gon.png')
                ->as('Gon.png') // Optional
                ->withMime('image/png') // Optional
        ];
    }
}
````

-In route file:
````php
Route::get('/mail', function () {
    \Illuminate\Support\Facades\Mail::to('EmailAddress@gmail.com')
        ->send(new \App\Mail\welcome());
});
````


- pass data to a view in mailer class
````php
protected Model $Data;

    public function __construct($passedData)
    {
        $this->Data = $passedData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Subject',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            'welcome', null, null, null, ['data' => $this->Data]
        );

    }
````