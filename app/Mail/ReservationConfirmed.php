<?php

namespace App\Mail;

use App\Models\EvenementUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct(EvenementUser $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('Votre réservation a été accepté')
                    ->view('emails.reservation_accepted');
    }
}
