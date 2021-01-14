<?php

namespace App\Notifications;

use App\Mail\MailMailableSend;
use App\MailMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
// If you can using Queue then  -- implements ShouldQueue --
class Mailable extends Notification
{
    use Queueable;

    public $type,$data,$subject;

    /**
     * Create a new notification instance.
     *
     * @param $type
     * @param $subject
     * @param $user
     * @param $data
     */
    public function __construct($type,$data)
    {
        $this->type = $type;
        $this->data = $data;
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
     * @return MailMailableSend
     */
    public function toMail($notifiable)
    {
        if($this->type !== 'mail_test'){
            $mailable = MailMailable::where('type',$this->type)->with('mailTemplateMap')->first();

            $this->subject = $mailable->label;
            foreach($this->data as $key => $value){
                $this->subject = str_replace('[[ '.$key.' ]]' , $this->data[$key] , $this->subject);
            }

            if (isset($this->type) && in_array($this->type,['contact_us'])){
                $email = $notifiable->routes['mail'];
            }else{
                $email = $notifiable->email;
            }

            return (new MailMailableSend($mailable,$this->data))->to($email)
                ->subject($this->subject);
        }else{
            return (new MailMailableSend(null,$this->data))->to($notifiable->routes['mail']);
        }


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
