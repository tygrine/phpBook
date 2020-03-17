<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Post;
use App\Like;

class Notify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, $is_like, $is_replied)
    {
        $this->post = $post;
        $this->is_replied = $is_replied;
        $this->is_like = $is_like;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'post' => $this->post,
            'user' => auth()->user(),
            'reply' => $this->is_replied,
            'like' => $this->is_like
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
                'post' => $this->post,
                'user' => auth()->user(),
                'reply' => $this->is_replied,
                'like' => $this->is_like
            ]
        ];
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
