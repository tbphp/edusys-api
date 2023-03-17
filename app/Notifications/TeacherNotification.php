<?php

namespace App\Notifications;

use App\Models\Teacher;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeacherNotification extends Notification
{
    public function via(Teacher $teacher): array
    {
        return ['mail'];
    }

    public function toMail(Teacher $teacher): MailMessage
    {

        return (new MailMessage)
            ->template('email')
            ->subject('')
            ->line('')
            ->action('点击查看', url('/'));
    }

    public function toArray(Teacher $teacher): array
    {
        return [];
    }
}
