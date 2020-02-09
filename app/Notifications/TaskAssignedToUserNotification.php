<?php

namespace App\Notifications;

use App\Entities\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification as BaseNotification;
use App\Entities\Notification;

class TaskAssignedToUserNotification extends BaseNotification
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
        return ['mail', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $line = $notifiable->name;
        return (new MailMessage)
                    ->line($this->notification->title )
                    ->action('View notification in app', route('home') )
                    ->line('Hi, ' . $line . '! a task has been assigned to you');
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user_id' => $notifiable->id,
            'task_id' => $this->task->id,
            'message' => 'A task has been assigned to you' ,
            'notification_id' => $this->notification->id
        ]);
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
