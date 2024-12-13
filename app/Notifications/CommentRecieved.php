<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Comment;

class CommentRecieved extends Notification
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        $commentable = $this->comment->commentable;
        $type = class_basename($commentable);
        $url = $this->getCommentableUrl($commentable);

        return (new MailMessage)
                    ->subject('You have a new comment on your ' . strtolower($type) . '!')
                    ->line('Someone has commented on your ' . strtolower($type) . '!')
                    ->action('Check it out', $url)
                    ->line('Thank you for using side by side!');
    }

    protected function getCommentableUrl($commentable){
        if (!$commentable) {
            return url('/');
        }

        if ($commentable instanceof \App\Models\Article) {
            return route('articles.show', $commentable->id);
        } elseif ($commentable instanceof \App\Models\Topic) {
            return route('topics.show', $commentable->id);
        }

        return url('/');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'comment_id' => $this->comment->id,
            'commentable_type' => $this->comment->commentable_type,
            'commentable_id' => $this->comment->commentable_id,
        ];
    }
}
