<?php

namespace App\Notifications\Forum;

use App\Models\ForumComment;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ForumCommentApprovedNotification extends Notification
{
    use Queueable;

    private ForumComment $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ForumComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param User $user
     * @return array
     */
    public function via(User $user)
    {
        return ['mail', 'database'];
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
            ->subject('Yorumun onaylandı.')
            ->line('Yorumun onaylandı.')
            ->line(new HtmlString("<b>Yorum</b>"))
            ->line($this->comment->comment);
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
            'comment' => $this->comment->comment
        ];
    }
}
