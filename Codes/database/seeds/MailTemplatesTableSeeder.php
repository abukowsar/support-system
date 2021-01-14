<?php

use Illuminate\Database\Seeder;

class MailTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mail_templates')->delete();
        
        \DB::table('mail_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Open-Ticket',
                'label' => 'Open Ticket Template',
                'description' => NULL,
                'template_detail' => '<p style="color: #626262;">Hi,</p>
<p style="color: #626262;">The ticket (#[[ id ]]) has been opened.</p>
<p style="color: #626262;"><span style="font-weight: bold;">Ticket Details :&nbsp;</span></p>
<p style="color: #626262;"><span style="font-weight: bold;">Issue : [[ subject ]] -&nbsp;</span><span style="font-weight: bold;">[[ priority ]] ,</span></p>
<p style="color: #626262;">[[ description ]]</p>
<p style="color: #626262;"><span style="color: #626262; background-color: #ffffff;">please log into your account on our site directly and solved&nbsp;</span><span style="background-color: #ffffff; color: #626262;">ticket based</span><span style="color: #626262;">&nbsp;&nbsp;on</span><span style="color: #626262;">&nbsp;priority</span><span style="color: #626262;">.</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-02 10:41:52',
                'updated_at' => '2019-12-04 10:36:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Assigned-Ticket',
                'label' => 'Assigned Ticket Template',
                'description' => NULL,
                'template_detail' => '<p style="color: #626262;">Hello Team,</p>
<p style="color: #626262;">The ticket (#[[ id ]]) has been assigned you, with&nbsp;<span style="font-weight: bold;">[[ priority ]]</span>&nbsp;priority.</p>
<p style="color: #626262;"><span style="font-weight: bold;">Ticket Details :&nbsp;</span></p>
<p style="color: #626262;"><span style="font-weight: bold;">Issue : [[ subject ]] -&nbsp;</span><span style="font-weight: bold;">[[ priority ]] ,</span></p>
<p style="color: #626262;">[[ description ]]</p>
<p style="color: #626262;">please log into your account on our site directly and solved&nbsp;<span style="background-color: #ffffff; color: #626262;">ticket based</span><span style="color: #626262;">&nbsp;&nbsp;on&nbsp;</span><span style="color: #626262;">priority</span><span style="color: #626262;">.</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-02 10:41:57',
                'updated_at' => '2019-12-04 10:36:24',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'contact-us',
                'label' => 'Contact Us Template',
                'description' => NULL,
                'template_detail' => '<p style="color: #626262;">Hello Admin,</p>
<p style="color: #626262;">Name : [[ name ]]</p>
<p style="color: #626262;">Email : [[ email ]]&nbsp;</p>
<p style="color: #626262;"><span style="color: #626262; background-color: #ffffff;">Mobile No : [[ mobile_no ]]</span></p>
<p style="color: #626262;">Message : [[ message ]]</p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-03 05:30:27',
                'updated_at' => '2019-12-04 10:36:41',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Solved-Ticket',
                'label' => 'Solved Ticket Template',
                'description' => NULL,
                'template_detail' => '<p style="color: #626262;">Hi [[ user ]],</p>
<p style="color: #626262;">The ticket (#[[ id ]]) has been solved.</p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">Feel free to close this ticket now, since the issue is resolved.&nbsp;</span></p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;"><a href="[[ link ]]">Click here</a>&nbsp;to view the ticket&nbsp;</span></p>
<p style="color: #626262;">If you believe that the ticket should be re-opened, please log into your account on our site directly and manually re-open the ticket</p>
<p style="color: #626262;">&nbsp;</p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-03 09:06:16',
                'updated_at' => '2019-12-04 10:36:58',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Re-open-Ticket',
                'label' => 'Re-open Ticket Template',
                'description' => NULL,
                'template_detail' => '<p style="color: #626262;">Hi,</p>
<p style="color: #626262;">The ticket (#[[ id ]]) has been re-opened.</p>
<p style="color: #626262;"><span style="font-weight: bold;">Ticket Details :&nbsp;</span></p>
<p style="color: #626262;"><span style="font-weight: bold;">Issue : [[ subject ]] -&nbsp;</span><span style="font-weight: bold;">[[ priority ]] ,</span></p>
<p style="color: #626262;">[[ description ]]</p>
<p style="color: #626262;"><span style="color: #626262; background-color: #ffffff;">please log into your account on our site directly and solved&nbsp;</span><span style="background-color: #ffffff; color: #626262;">ticket based</span><span style="color: #626262;">&nbsp;&nbsp;on</span><span style="color: #626262;">&nbsp;priority</span><span style="color: #626262;">.</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-03 10:05:37',
                'updated_at' => '2019-12-05 09:06:34',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'New-Request',
                'label' => 'New Ticket Request Template',
                'description' => NULL,
                'template_detail' => '<p style="color: #626262;">Hi,</p>
<p style="color: #626262;">The ticket (#[[ id ]])&nbsp; New Ticket Request.</p>
<p style="color: #626262;"><span style="font-weight: bold;">Ticket Details :&nbsp;</span></p>
<p style="color: #626262;"><span style="font-weight: bold;">Subject : [[ subject ]] -&nbsp;</span><span style="font-weight: bold;">[[ priority ]]&nbsp;</span></p>
<p style="color: #626262;">[[ description ]]</p>
<p style="color: #626262;"><span style="color: #626262; background-color: #ffffff;">please log into your account on our site directly and solved&nbsp;</span><span style="background-color: #ffffff; color: #626262;">ticket based</span><span style="color: #626262;">&nbsp;&nbsp;on</span><span style="color: #626262;">&nbsp;priority</span><span style="color: #626262;">.</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-03 10:05:48',
                'updated_at' => '2019-12-04 10:37:21',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Ticket-Reply',
                'label' => 'Ticket Reply Template',
                'description' => NULL,
                'template_detail' => '<p style="color: #626262;">Hi [[ user ]],</p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">There is a new comment from Team.</span></p>
<p style="border: 0px; padding: 0px; margin: 25px 0px; background: no-repeat; color: #626262; box-sizing: border-box; font-family: Lato;"><span style="border: 0px; padding: 0px; margin: 0px; background: no-repeat; color: inherit; box-sizing: border-box; font-weight: bold;">Comment :&nbsp;</span></p>
<p style="border: 0px; padding: 0px; margin: 25px 0px; background: no-repeat; color: #626262; box-sizing: border-box; font-family: Lato;">[[ description ]]</p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">Thanks for your help!&nbsp;</span></p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">Feel free to close this ticket now, since the issue is resolved.&nbsp;</span></p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;"><a href="[[ link ]]">Click here</a>&nbsp;to view the ticket&nbsp;</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-03 10:06:38',
                'updated_at' => '2019-12-04 10:38:01',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Closed-Ticket',
                'label' => 'Closed Ticket Template',
                'description' => NULL,
                'template_detail' => '<p style="color: #626262;">Hi,</p>
<p style="color: #626262;">The ticket (#[[ id ]]) has been closed.</p>
<p style="color: #626262;"><span style="font-weight: bold;">Ticket Details :&nbsp;</span></p>
<p style="color: #626262;"><span style="font-weight: bold;">Issue : [[ subject ]] -&nbsp;</span><span style="font-weight: bold;">[[ priority ]] ,</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;"><span style="color: #262626; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">Please be aware that ticket&nbsp;<strong>#[[ id ]]&nbsp;</strong>has been resolved and closed.</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-03 10:07:48',
                'updated_at' => '2019-12-05 09:11:29',
            ),
        ));
        
        
    }
}