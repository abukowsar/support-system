<?php

namespace App\Notifications;

use App\Mail\MailMailableSend;
use App\MailMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;
use ThibaudDauce\Mattermost\Attachment;
use ThibaudDauce\Mattermost\MattermostChannel;
use ThibaudDauce\Mattermost\Message as MattermostMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class CommonNotification extends Notification /*implements ShouldQueue*/
{
    // use Queueable;

    public $type, $data, $subject, $mailable, $notification_message, $notification_link,$appData;

    /**
     * Create a new notification instance.
     *
     * @param $type
     * @param $data
     */
    public function __construct($type, $data)
    {
        $this->type = $type;
        $this->data = $data;
        $this->mailable = isset($data['mailableTemplate'])?$data['mailableTemplate'] :MailMailable::where('type',$this->type)->with('mailTemplateMap')->first();
        $this->subject = $this->mailable->defaultMailTemplateMap->subject;
        $this->notification_message = $this->mailable->mailTemplateMap[0]->notification_message;
        $this->notification_link = $this->mailable->mailTemplateMap[0]->notification_link;

        foreach($this->data as $key => $value){
            $this->subject = str_replace('[[ '.$key.' ]]' , $this->data[$key] , $this->subject);
            $this->notification_message = str_replace('[[ '.$key.' ]]' , $this->data[$key] , $this->notification_message);
            $this->notification_link = str_replace('[[ '.$key.' ]]' , $this->data[$key] , $this->notification_link);
        }

        $this->appData = \App\AppSetting::getData();


    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $notificationSettings=$this->appData->notification_settings;
        $notification_settings = [];
        $notification_access =isset($notificationSettings[$this->type]) ? $notificationSettings[$this->type] : [];

        foreach(config('config.notification') as $key => $notification) {
            if(isset($notification_access[$key]) && $notification_access[$key]) {
                switch($key) {
                    case 'mail':
                        array_push($notification_settings, 'mail');
                        break;
                    case 'web_push':
                        array_push($notification_settings, WebPushChannel::class);
                        break;
                    case 'mattermost':
                        array_push($notification_settings, MattermostChannel::class);
                        break;
                    case 'slack':
                        array_push($notification_settings, 'slack');
                        break;
                }
            }
        }

        return $notification_settings;
        //return [ 'mail', MattermostChannel::class, WebPushChannel::class];
    }

    /**
     * Get Mattermost notification
     *
     * @param mixed $notifiable
     * @return MattermostMessage
     */
    public function toMattermost($notifiable)
    {
        return (new MattermostMessage)
            ->username($this->appData->site_name)
            ->iconUrl(getSingleMedia($this->appData,'site_logo'))
            ->attachment(function (Attachment $attachment) {
                $attachment->success()
                    ->title($this->subject, $this->notification_link)
                    ->field('Description', strip_tags($this->notification_message), false);
            });
    }


    public function toSlack($notifiable)
    {
       return (new SlackMessage)
           ->success()
           ->image(getSingleMedia($this->appData,'site_logo'))
           ->attachment(function ($attachment) {
               $attachment->title($this->subject, $this->notification_link)
                   ->content(strip_tags($this->notification_message));
           });
            
    }

    /**
     * Get WebPush notification
     *
     * @param $notifiable
     * @param $notification
     * @return WebPushMessage
     */
    public function toWebPush($notifiable)
    {
        return (new WebPushMessage)
            ->title($this->subject)
            ->icon(getSingleMedia($this->appData,'site_logo'))
            ->body($this->notification_message);
            // ->action('View Details', $this->notification_link);
    }

    /**
     * Get mail notification
     *
     * @param mixed $notifiable
     * @return MailMailableSend
     */
    public function toMail($notifiable)
    {
        $email = '';

        if(isset($notifiable->email)) {
            $email = $notifiable->email;
        } else {
            $email = $notifiable->routes['mail'];
        }


        return (new MailMailableSend($this->mailable, $this->data))->to($email)
                    ->bcc(isset($this->mailable->bcc)? json_decode($this->mailable->bcc) : [])
                    ->cc(isset($this->mailable->cc)? json_decode($this->mailable->cc) : [])
                    ->subject($this->subject);
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
