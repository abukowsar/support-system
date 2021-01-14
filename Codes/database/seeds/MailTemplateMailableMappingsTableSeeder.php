<?php

use Illuminate\Database\Seeder;

class MailTemplateMailableMappingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mail_template_mailable_mappings')->delete();
        
        \DB::table('mail_template_mailable_mappings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'mailable_id' => 1,
                'template_id' => 1,
                'language' => 'en',
                'subject' => 'Open Ticket # [[ id ]] - [[ subject ]] - [[ priority ]]',
                'template_detail' => '<p>Hi,</p>
<p>The ticket (#[[ id ]]) has been opened.</p>
<p><strong>Ticket Details :&nbsp;</strong></p>
<p><strong>Issue : [[ subject ]] -&nbsp;</strong><strong>[[ priority ]] ,</strong></p>
<p>[[ description ]]</p>
<p><span style="color: #626262; background-color: #ffffff;">please log into your account on our site directly and solved&nbsp;</span><span style="background-color: #ffffff; color: #626262;">ticket based</span><span style="color: #626262;">&nbsp;&nbsp;on</span><span style="color: #626262;">&nbsp;priority</span><span style="color: #626262;">.</span></p>
<p>Regards,</p>
<p>Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-02 10:44:21',
                'updated_at' => '2019-12-04 10:32:32',
            ),
            1 => 
            array (
                'id' => 2,
                'mailable_id' => 1,
                'template_id' => 1,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => NULL,
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-02 10:44:21',
                'updated_at' => '2019-12-04 10:32:32',
            ),
            2 => 
            array (
                'id' => 3,
                'mailable_id' => 2,
                'template_id' => 2,
                'language' => 'en',
                'subject' => 'Ticket Assign # [[ id ]] -  [[ subject ]] - [[ priority ]]',
                'template_detail' => '<p style="color: #626262;">Hello Team,</p>
<p style="color: #626262;">The ticket (#[[ id ]]) has been assigned you, with&nbsp;<strong>[[ priority ]]</strong> priority.</p>
<p style="color: #626262;"><span style="font-weight: bold;">Ticket Details :&nbsp;</span></p>
<p style="color: #626262;"><span style="font-weight: bold;">Issue : [[ subject ]] -&nbsp;</span><span style="font-weight: bold;">[[ priority ]] ,</span></p>
<p style="color: #626262;">[[ description ]]</p>
<p style="color: #626262;">please log into your account on our site directly and solved&nbsp;<span style="background-color: #ffffff; color: #626262;">ticket based</span><span style="color: #626262;">&nbsp;&nbsp;on&nbsp;</span><span style="color: #626262;">priority</span><span style="color: #626262;">.</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-02 12:36:50',
                'updated_at' => '2019-12-04 13:15:38',
            ),
            3 => 
            array (
                'id' => 4,
                'mailable_id' => 2,
                'template_id' => 2,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => NULL,
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-02 12:36:50',
                'updated_at' => '2019-12-04 13:15:38',
            ),
            4 => 
            array (
                'id' => 5,
                'mailable_id' => 3,
                'template_id' => 3,
                'language' => 'en',
                'subject' => 'Contact us',
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
                'created_at' => '2019-12-03 05:39:16',
                'updated_at' => '2019-12-04 06:47:02',
            ),
            5 => 
            array (
                'id' => 6,
                'mailable_id' => 3,
                'template_id' => 3,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => NULL,
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-03 05:39:16',
                'updated_at' => '2019-12-04 06:47:02',
            ),
            6 => 
            array (
                'id' => 9,
                'mailable_id' => 5,
                'template_id' => 4,
                'language' => 'en',
                'subject' => 'Solved Ticket # [[ id ]] - [[ subject ]]',
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
                'created_at' => '2019-12-03 09:07:07',
                'updated_at' => '2019-12-04 10:33:38',
            ),
            7 => 
            array (
                'id' => 10,
                'mailable_id' => 5,
                'template_id' => 4,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => NULL,
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-03 09:07:08',
                'updated_at' => '2019-12-04 10:33:38',
            ),
            8 => 
            array (
                'id' => 11,
                'mailable_id' => 6,
                'template_id' => 6,
                'language' => 'en',
                'subject' => 'New Ticket Request # [[ id ]] -  [[ subject ]] - [[ priority ]]',
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
                'created_at' => '2019-12-03 10:55:13',
                'updated_at' => '2019-12-04 10:34:59',
            ),
            9 => 
            array (
                'id' => 12,
                'mailable_id' => 6,
                'template_id' => 6,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => NULL,
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-03 10:55:14',
                'updated_at' => '2019-12-04 10:34:59',
            ),
            10 => 
            array (
                'id' => 13,
                'mailable_id' => 7,
                'template_id' => 1,
                'language' => 'en',
                'subject' => 'Support Ticket Auto Reply Message',
                'template_detail' => '<p style="color: #626262;">Hi [[ user ]],</p>
<p style="color: #626262;">Thank you for contacting Saul\'s! This is your ticket number - <strong>#[[ id ]]</strong>. To view the status of your ticket or to add your comments, please use this link here -&nbsp;<a href="[[ link ]]">[[ link ]]</a></p>
<p style="color: #626262;"><span style="color: #626262;">&nbsp;A support representative will be reviewing your request and will send you a personal response within a day.&nbsp;</span></p>
<p style="color: #626262;"><span style="color: #626262;"> Thank you for your patience.&nbsp;</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-04 06:46:30',
                'updated_at' => '2019-12-04 10:35:09',
            ),
            11 => 
            array (
                'id' => 14,
                'mailable_id' => 7,
                'template_id' => 1,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => '<p style="color: #626262;">Hi,</p>
<p style="color: #626262;">The ticket (#[[ id ]]) has been opened.</p>
<p style="color: #626262;"><span style="font-weight: bold;">Ticket Details :&nbsp;</span></p>
<p style="color: #626262;"><span style="font-weight: bold;">Issue : [[ subject ]] -&nbsp;</span><span style="font-weight: bold;">[[ priority ]] ,</span></p>
<p style="color: #626262;">[[ description ]]</p>
<p style="color: #626262;"><span style="color: #626262; background-color: #ffffff;">please log into your account on our site directly and solved&nbsp;</span><span style="background-color: #ffffff; color: #626262;">ticket based</span><span style="color: #626262;">&nbsp;&nbsp;on&nbsp;</span><span style="color: #626262;">[[ priority ]] priority</span><span style="color: #626262;">.</span></p>
<p style="color: #626262;">Regards</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-04 06:46:30',
                'updated_at' => '2019-12-04 10:35:09',
            ),
            12 => 
            array (
                'id' => 15,
                'mailable_id' => 8,
                'template_id' => 7,
                'language' => 'en',
                'subject' => 'Replied Ticket # [[ id ]] - [[ subject ]]',
                'template_detail' => '<p style="color: #626262;">Hi [[ user ]],</p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">There is a new comment from Team.</span></p>
<p style="border: 0px; padding: 0px; margin: 25px 0px; background: no-repeat; color: #626262; box-sizing: border-box; font-family: Lato;"><span style="border: 0px; padding: 0px; margin: 0px; background: no-repeat; color: inherit; box-sizing: border-box; font-weight: bold;">Comment :&nbsp;</span></p>
<p style="border: 0px; padding: 0px; margin: 25px 0px; background: no-repeat; color: #626262; box-sizing: border-box; font-family: Lato;">[[ description ]]</p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">Thanks for your help!&nbsp;</span></p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">Feel free to close this ticket now, since the issue is resolved.&nbsp;</span></p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;"><a href="[[ link ]]">Click here</a> to view the ticket&nbsp;</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-04 07:18:15',
                'updated_at' => '2019-12-04 10:35:20',
            ),
            13 => 
            array (
                'id' => 16,
                'mailable_id' => 8,
                'template_id' => 7,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => NULL,
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-04 07:18:16',
                'updated_at' => '2019-12-04 10:35:20',
            ),
            14 => 
            array (
                'id' => 17,
                'mailable_id' => 9,
                'template_id' => 5,
                'language' => 'en',
                'subject' => 'Re-Open Ticket # [[ id ]] - [[ subject ]]',
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
                'created_at' => '2019-12-05 09:05:44',
                'updated_at' => '2019-12-05 09:05:44',
            ),
            15 => 
            array (
                'id' => 18,
                'mailable_id' => 9,
                'template_id' => 5,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => NULL,
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-05 09:05:44',
                'updated_at' => '2019-12-05 09:05:44',
            ),
            16 => 
            array (
                'id' => 19,
                'mailable_id' => 10,
                'template_id' => 8,
                'language' => 'en',
                'subject' => 'Closed Ticket # [[ id ]] - [[ subject ]] - [[ priority ]]',
                'template_detail' => '<p style="color: #626262;">Hi,</p>
<p style="color: #626262;">The ticket (#[[ id ]]) has been closed.</p>
<p style="color: #626262;"><span style="font-weight: bold;">Ticket Details :&nbsp;</span></p>
<p style="color: #626262;"><span style="font-weight: bold;">Issue : [[ subject ]] -&nbsp;</span><span style="font-weight: bold;">[[ priority ]] ,</span></p>
<p><span style="color: #262626; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">Please be aware that ticket <strong>#[[ id ]] </strong>has been resolved and closed.</span></p>
<p style="color: #626262;"><span style="background-color: initial;">Regards,</span></p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-05 09:11:09',
                'updated_at' => '2019-12-05 09:11:09',
            ),
            17 => 
            array (
                'id' => 20,
                'mailable_id' => 10,
                'template_id' => 8,
                'language' => 'ar',
                'subject' => NULL,
                'template_detail' => NULL,
                'notification_message' => NULL,
                'notification_link' => NULL,
                'status' => 1,
                'created_at' => '2019-12-05 09:11:09',
                'updated_at' => '2019-12-05 09:11:09',
            ),
            18 => 
            array (
                'id' => 21,
                'mailable_id' => 11,
                'template_id' => 7,
                'language' => 'en',
                'subject' => 'Replied Ticket # [[ id ]] - [[ subject ]]',
                'template_detail' => '<p style="color: #626262;">Hi ,</p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">There is a new comment from [[ user ]].</span></p>
<p style="border: 0px; padding: 0px; margin: 25px 0px; background: no-repeat; color: #626262; box-sizing: border-box; font-family: Lato;"><span style="border: 0px; padding: 0px; margin: 0px; background: no-repeat; color: inherit; box-sizing: border-box; font-weight: bold;">Comment :&nbsp;</span></p>
<p style="border: 0px; padding: 0px; margin: 25px 0px; background: no-repeat; color: #626262; box-sizing: border-box; font-family: Lato;">[[ description ]]</p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">Thanks for your help!&nbsp;</span></p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;">Feel free to close this ticket now, since the issue is resolved.&nbsp;</span></p>
<p style="color: #626262;"><span style="color: #626262; font-family: Lato;"><a href="[[ link ]]">Click here</a>&nbsp;to view the ticket&nbsp;</span></p>
<p style="color: #626262;">Regards,</p>
<p style="color: #626262;">Iqonic Design</p>',
                'notification_message' => '[[ description ]]',
                'notification_link' => '[[ link ]]',
                'status' => 1,
                'created_at' => '2019-12-05 09:20:30',
                'updated_at' => '2019-12-05 09:20:30',
            ),
            19 => 
            array (
                'id' => 22,
                'mailable_id' => 11,
                'template_id' => 7,
                'language' => 'ar',
                'subject' => NULL,
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
                'created_at' => '2019-12-05 09:20:30',
                'updated_at' => '2019-12-05 09:20:30',
            ),
        ));
        
        
    }
}