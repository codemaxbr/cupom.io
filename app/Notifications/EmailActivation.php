<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailActivation extends Notification
{
    use Queueable;

    private $user;
    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = (object) $data;
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
        $data = $this->data;

        return (new MailMessage)
            ->success()
            ->greeting('Olá, '.$data->name)
            ->subject('Confirme seu cadastro')
            ->line('Obrigado por se cadastrar no GerentePRO')
            ->line('Para a ativação do seu cadastro, por favor clique ou acesse o link abaixo para confirmar o seu endereço de email.')
            ->action('Confirmar E-mail', route('confirmation', $data->token))
            ->line('Após ser confirmado, você pode entrar em seu GerentePRO em https://'.$data->domain.'.gerentepro.com.br.')
            ->line('Em caso de dúvidas, entre em contato com a equipe de atendimento ao cliente.');
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
