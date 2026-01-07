<?php

namespace App\Notifications;

use App\Models\RentalAgreement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RentalRejectedNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected RentalAgreement $rental
    ) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your rental request was rejected.',
            'apartment_id' => $this->rental->apartment_id,
            'rental_id' => $this->rental->id,
        ];
    }
}
