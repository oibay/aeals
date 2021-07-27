<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;

class Telegram extends Notification
{
    use Queueable;

    protected $message;
    protected $urlFile;
    protected $statusID;
    protected $user;
    protected $super;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $urlFile, $statusID, $user, $super = null)
    {
        $this->message = $message;
        $this->urlFile = $urlFile;
        $this->statusID = $statusID;
        $this->user = $user;
        $this->super = $super;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toTelegram($notifiable)
    {
        $url = 'https://aea-ls.kz/qu2/' . $this->statusID . '/' . $this->user->id;
        if ($this->urlFile) {
            $telegram = TelegramFile::create()
                ->content($this->message)
                ->photo($this->urlFile);
            if ($this->super == null) {
                return $telegram->button('Сделал(а)', $url);
            } else {
                return $telegram;
            }
        } else {
            $telegram = TelegramMessage::create()
                ->content($this->message);
            if ($this->super == null) {
                return $telegram->button('Сделал(а)', $url);
            } else {
                return $telegram;
            }
        }

    }
}
