<?php

namespace App\Notifications;

use App\Entities\Notification;
use App\Entities\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification as BaseNotification;

class TaskCompletedNotification extends BaseNotification
{
    use Queueable;

    /**
     * @var \App\Entities\Task
     */
    private $task;

    /**
     * @var \Illuminate\Notifications\Notification
     */
    private $notification;

    /**
     * Create a new notification instance.
     *
     * @param \App\Entities\Task $task
     * @param \App\Entities\Notification $notification
     */
    public function __construct(Task $task, Notification $notification)
    {
        //
        $this->task = $task;
        $this->notification = $notification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Task completed.')
                    ->action('Open in app', route('web-app'))
                    ->line('Hi! task has been completed');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
