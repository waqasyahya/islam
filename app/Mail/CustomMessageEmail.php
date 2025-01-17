<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomMessageEmail extends Mailable
{
    use SerializesModels;

    public $messageContent;

    /**
     * Create a new message instance.
     *
     * @param string $messageContent
     * @return void
     */
    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('custom-message')
            ->from(config('mail.from.address'), 'islameapp')
            ->subject('islameapp')
            ->with([
                'messageContent' => $this->messageContent,
            ]);
    }
}
