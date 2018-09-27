<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Contributor;
use App\Models\Lesson;
use App\Models\Member;

class ContribReplyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member, Lesson $lesson, Contributor $contrib)
    {
        $this->member = $member;
        $this->lesson = $lesson;
        $this->contrib = $contrib;
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
        $url = url('/lessons/'.$this->lesson->slug);
        return (new MailMessage)
                    ->subject('Notification From Cilsy Fiolution')
                    ->greeting(sprintf('Hello %s', $this->contrib->first_name))
                    ->line(sprintf('Halo, %s telah menjawab Pertanyaan pada tutorial %s,', $this->contrib->first_name, $this->lesson->title))
                    ->action('Lihat Diskusi', $url)
                    ->line('Terima Kasih telah menggunakan aplikasi kami!');
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
