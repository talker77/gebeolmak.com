<?php

namespace App\Notifications\Forum;

use App\Models\ForumComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ForumCommentRejectedNotification extends Notification
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
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('Yorumun onaylanmadı !')
            ->line('Yorumun onaylanmadı.')
            ->line(new HtmlString("<b>Yorum</b>"))
            ->line($this->comment->comment)
            ->line("Yorumun spam veya kötü niyetli olarak algılanmış olabilir.");
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
