<?php

namespace App\Mail;

use App\Models\EvenementUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationDeclined extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct(EvenementUser $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('Votre réservation a été déclinée')
                    ->view('emails.reservation_declined');
    }
}
