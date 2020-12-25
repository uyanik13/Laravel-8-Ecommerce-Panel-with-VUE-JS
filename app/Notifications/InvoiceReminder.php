<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\ChatAPI\ChatAPIChannel;
use NotificationChannels\ChatAPI\ChatAPIMessage;

class InvoiceReminder extends Notification
{
    use Queueable;
    protected $title;
    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title,$message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail','database', 'nexmo',ChatAPIChannel::class];
        //return ['mail','database'];
        return ['database','mail'];
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
            ->subject($this->title)
            ->markdown('mail.invoiceNotify',
                ['title' => $this->title, 'message' => $this->message]
            );
      //->cc('ogur.uyanik13@gmail.com')
    }

//    /**
//     * Get the Nexmo / SMS representation of the notification.
//     *
//     * @param  mixed  $notifiable
//     * @return NexmoMessage
//     */
//    public function toNexmo($notifiable)
//    {
//        $message= 'Merhaba'.$this->user['name']."\n".$this->invoice['name'].'Borcunuz:'."\n".$this->invoice['price'].'TL'."\n".config('app.url').'/admin/invoicesShow/'.$this->invoice['invoice_id'];
//        return (new NexmoMessage)
//            ->content($message)->unicode();
//
//    }
//
//
//    /**
//     * Get the Chat api.
//     *
//     * @param  mixed  $notifiable
//     * @return ChatAPIMessage
//     */
//    public function toChatAPI($notifiable)
//    {   $message= 'Merhaba'.$this->user['name']."\n".$this->invoice['name'].'Borcunuz:'."\n".$this->invoice['price'].'TL'."\n".config('app.url').'/admin/invoicesShow/'.$this->invoice['invoice_id'];
//        return ChatAPIMessage::create()
//            //->to($this->user['phone_number']) // your user phone
//            ->content($message);
//    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {

        return [
            'title' => $this->title,
            'message' => $this->message
        ];
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
