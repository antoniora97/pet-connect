<?php

namespace App\Notifications;

use App\Enum\GenderEnum;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventCreatedNotification extends Notification {
    use Queueable;

    protected $event;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
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
        $subject = "Invitación a " . $this->event->title;

        $greeting = 'Hola ' . $notifiable->person1_name;
        if ($notifiable->person2_name) {
            $greeting = $greeting . " y " . $notifiable->person2_name;
        }

        $countPets = 0;
        $petIndex = -1;
        foreach ($notifiable->pets as $pet) {
            if ($pet->race_id == $this->event->race_id) {
                $countPets = $countPets + 1;
                $petIndex = $notifiable->pets->search($pet);
            }
        }

        $body = '';
        if ($countPets==1) {
            if ($notifiable->pets[$petIndex]->gender->name == GenderEnum::MALE->name()) {
                $body = "Tu perro " . ucfirst($notifiable->pets[$petIndex]->name) . " ha sido invitado al siguiente evento: ";
            } else {
                $body = "Tu perra " . ucfirst($notifiable->pets[$petIndex]->name) . " ha sido invitada al siguiente evento: ";
            }
        } else {
            $body = "Tu perros ";
            foreach ($notifiable->pets as $pet) {
                if ($pet->race_id == $this->event->race_id) {
                    if ($notifiable->pets->search($pet) == count($notifiable->pets)-1) {
                        $body = $body . "y ". ucfirst($pet->name);
                    } else if ($notifiable->pets->search($pet) == count($notifiable->pets)-2) {
                        $body = $body . ucfirst($pet->name) . " ";
                    } else {
                        $body = $body . ucfirst($pet->name) . ", ";
                    }
                }
            }
            $body = $body . " han sido invitados al siguiente evento: ";
        }
        $body = $body . $this->event->title . " el " . $this->event->date . " a las " . $this->event->time . ".";


        return (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->line($body)
            ->salutation('Muchas gracias por usar Pet Connect.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
