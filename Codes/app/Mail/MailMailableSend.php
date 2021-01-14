<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\MailMailable;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailMailableSend extends Mailable
{
    use Queueable, SerializesModels;

    public $mailable,$data,$templateData;

    /**
     * Create a new message instance.
     *
     * @param $type
     * @param $data
     */
    public function __construct($mailable,$data)
    {
        $this->mailable = $mailable ?? '';
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->mailable !== ''){
            if(count($this->mailable->mailTemplateMap)){
                $template = $this->mailable->mailTemplateMap()->where('language','en')->first();

                $this->templateData = $template->template_detail;

                foreach($this->data as $key => $value){
                    $this->templateData = str_replace('[[ '.$key.' ]]' , $this->data[$key] , $this->templateData);
                }
            }
        }else{
            $this->templateData = $this->data['data'];
        }
        $message= $this->markdown('admin.mail.markdown');


        $files = isset($this->data['attachments'])?json_decode($this->data['attachments']):[]; 
           
       foreach ($files as $file) { 
           $message->attach($file); // attach each file
       }
       return $message; //Send mail
    }
}
