<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationConfirmed extends Notification
{
    use Queueable;


    protected $evenement;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($evenement, $user)
    {
        $this->evenement = $evenement;
        $this->user = $user;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->greeting('Bonjour ' . $this->user->name . ',')
        ->line('Votre réservation pour l\'événement "' . $this->evenement->name . '" a été confirmée.')
        ->line('Détails de l\'événement :')
        ->line('Nom : ' . $this->evenement->name)
        ->line('Description : ' . $this->evenement->description)
        ->line('Date de début : ' . $this->evenement->event_start_date)
        ->line('Date de fin : ' . $this->evenement->event_end_date)
        ->line('Lieu : ' . $this->evenement->location)
        ->action('Voir l\'événement', route('evenements.show', ['id' => $this->evenement->id]))
        ->line('Merci de votre réservation !');
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'event_name' => $this->reservation->event_name,
        ];
    }
}
