<?php

namespace App\Notifications;

use App\Violation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ViolationCreatedVerifier extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Violation $violation)
    {
        $this->violation = $violation;
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
                    ->subject('Butuh Verifikasi Pelanggaran Baru')
                    ->line('Terdapat Laporan Pelanggaran Baru yang Masuk.')
                    ->line('Nama Petugas: ' . auth()->user()->name)
                    ->line('Nama Pelanggar: ' . $this->violation->violator_name)
                    ->line('Nomor Identitas Pelanggar: ' . $this->violation->violator_identity_number)
                    ->line('Terima kasih sudah menggunakan aplikasi ini');
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
