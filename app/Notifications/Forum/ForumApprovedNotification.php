<?php

namespace App\Notifications\Forum;

use App\Models\Forum;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ForumApprovedNotification extends Notification
{
    use Queueable;

    private Forum $forum;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Forum $forum)
    {
        $this->forum = $forum;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
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
        $forum = $this->forum;

        return (new MailMessage)
            ->subject("Forumda açtığın konu onaylandı.")
            ->line("Forumda açtığın konu onaylandı.")
            ->line(new HtmlString("<b>Konu Bilgileri</b>"))
            ->line(new HtmlString("<b>ID : </b>". $forum->id))
            ->line(new HtmlString("<b>Başlık : </b>". $forum->title))
            ->line(new HtmlString("<b>Kategori : </b>". $forum->category->title))
            ->action('Konuyu Gör', url(route('forum.detail', ['forum' => $forum->slug])));
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
            'id' => $this->forum->id,
            'title' => $this->forum->title,
            'category' => $this->forum->category->title,
        ];
    }
}
