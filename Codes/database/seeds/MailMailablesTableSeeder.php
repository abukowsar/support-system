<?php

use Illuminate\Database\Seeder;

class MailMailablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mail_mailables')->delete();
        
        \DB::table('mail_mailables')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'open_ticket',
                'status' => 1,
                'to' => '["admin","department-leaders"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-02 10:44:21',
                'updated_at' => '2019-12-04 06:13:18',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'assign_ticket',
                'status' => 1,
                'to' => '["assigned-employee"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-02 12:36:50',
                'updated_at' => '2019-12-04 13:15:38',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'type' => 'contact_us',
                'status' => 1,
                'to' => '["ashwanee@goldenmace.com"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-03 05:39:16',
                'updated_at' => '2019-12-03 09:13:11',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'type' => 'solve_ticket',
                'status' => 1,
                'to' => '["ticket-user"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-03 09:07:07',
                'updated_at' => '2019-12-03 11:01:12',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'type' => 'new_ticket_request',
                'status' => 1,
                'to' => '["department-leaders"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-03 10:55:13',
                'updated_at' => '2019-12-03 10:57:21',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'type' => 'open_ticket',
                'status' => 1,
                'to' => '["ticket-user"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-04 06:46:29',
                'updated_at' => '2019-12-04 06:46:29',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'type' => 'reply_ticket',
                'status' => 1,
                'to' => '["ticket-user"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-04 07:18:15',
                'updated_at' => '2019-12-04 07:18:15',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'type' => 'reopen_ticket',
                'status' => 1,
                'to' => '["admin","department-leaders"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-05 09:05:44',
                'updated_at' => '2019-12-05 09:05:44',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'type' => 'closed_ticket',
                'status' => 1,
                'to' => '["admin","assigned-employee"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-05 09:11:09',
                'updated_at' => '2019-12-05 09:11:09',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'type' => 'reply_by_user',
                'status' => 1,
                'to' => '["admin","assigned-employee"]',
                'bcc' => NULL,
                'cc' => NULL,
                'created_at' => '2019-12-05 09:20:30',
                'updated_at' => '2019-12-05 09:20:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}