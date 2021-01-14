<?php

return array(
	'enable_social_login' => true,
	'social_login_provider' => array('google', 'facebook'),
	'enable_google_login' => true,
	'enable_facebook_login' => true,
    'notification' => [
        'web_push' => 'Web Push',
        'mattermost' => 'Mattermost',
        'mail' => 'Mail',
        'slack' => 'Slack',
    ]
);
