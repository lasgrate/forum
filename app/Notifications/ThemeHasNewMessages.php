<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ThemeHasNewMessages extends Notification
{
    use Queueable;

    /**
     * @var Message
     */
    protected $message;

    /**
     * ThemeHasNewMessages constructor.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
            ->subject('Invoice Paid')
            ->markdown('mail.notify.newMessage', [
                'message' => $this->message,
            ]);
    }

}
