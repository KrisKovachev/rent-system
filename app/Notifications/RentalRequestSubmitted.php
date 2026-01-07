<?php

namespace App\Notifications;

use App\Models\RentalRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RentalRequestSubmitted extends Notification
{
    use Queueable;

    public function __construct(
        public RentalRequest $rentalRequest
    ) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'rental_request_submitted',
            'rental_request_id' => $this->rentalRequest->id,
            'apartment_id' => $this->rentalRequest->apartment_id,
            'tenant_name' => $this->rentalRequest->user->name,
            'start_date' => $this->rentalRequest->start_date,
            'end_date' => $this->rentalRequest->end_date,
            'message' => $this->rentalRequest->message,
        ];
    }
}
