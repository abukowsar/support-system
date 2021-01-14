<?php

use Illuminate\Database\Seeder;

class AppSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('app_settings')->delete();
        
        \DB::table('app_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'site_name' => 'SofDesk',
                'site_email' => 'info@example.com',
                'site_logo' => 'logo.png',
                'site_footer_logo' => 'white-logo.png',
                'site_favicon' => 'favicon.png',
                'site_description' => 'Support Ticket and Knowledge base script',
                'google_map_api' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.840108181602!2d144.95373631539215!3d-37.8172139797516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1497005461921"',
                'site_copyright' => 'Copyright @2019 SofDesk',
                'theme_setting' => 1,
                'home_slide_title' => 'Searching for help?',
                'home_slide_text' => 'Go through our tremendous knowledge base',
                'page_bg_image' => '/tmp/phpqtKBXL',
                'about_title' => NULL,
                'about_description' => NULL,
                'contact_title' => 'Contact Us',
                'contact_address' => '1234 North Avenue Luke Lane, South Bend, IN 360001',
                'contact_email' => 'support@iqnonicthemes.com',
                'contact_number' => '+0123456789',
                'contact_lat' => NULL,
                'contact_long' => NULL,
                'facebook_url' => 'facebook.com',
                'twitter_url' => 'https://twitter.com/',
                'gplus_url' => 'https://google.com',
                'linkedin_url' => 'https://www.linkedin.com/',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}