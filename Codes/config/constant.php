<?php

return [

	'USER' => [
			'DEFAULT_IMAGE'   => '/images/user-profile.png',
		],
    'IMAGE_EXTENTIONS' => ['png','jpg','jpeg'],


	'DEFAULT_IMAGE'   => '/images/default.jpg',


    'PAGINATION' => [
			'SEARCH' => 9,

		],

    'USER_SAVE_IMAGE_PATH'   => '/uploads/profile-image',

    'MAIL_SETTING' => [
        'MAIL_DRIVER' => env('MAIL_DRIVER'),
        'MAIL_HOST' => env('MAIL_HOST'),
        'MAIL_PORT' => env('MAIL_PORT'),
        'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
        'MAIL_USERNAME' => env('MAIL_USERNAME'),
        'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
    ],

    'CONFIGURATION' => [
        'APP_NAME' => env('APP_NAME'),
//        'APP_DEBUG' => env('APP_DEBUG'),
        'APP_SLOGUN' => env('App_SLOGUN')
    ],

    'SOCIAL' => [
        'facebook'=>[
            'FACEBOOK_CLIENT_ID' => env('FACEBOOK_CLIENT_ID'),
            'FACEBOOK_CLIENT_SECRET' => env('FACEBOOK_CLIENT_SECRET'),
            'FACEBOOK_REDIRECT' => env('FACEBOOK_REDIRECT')
        ],
        'google'=> [
            'GOOGLE_APP_ID' => env('GOOGLE_APP_ID'),
            'GOOGLE_APP_SECRET' => env('GOOGLE_APP_SECRET'),
            'GOOGLE_REDIRECT' => env('GOOGLE_REDIRECT'),
        ],
        'twitter'=> [
            'TWITTER_APP_ID'=>env('TWITTER_APP_ID'),
            'TWITTER_APP_SECRET'=>env('TWITTER_APP_SECRET'),
            'TWITTER_REDIRECT'=>env('TWITTER_REDIRECT'),
        ]
    ],

    'COLOR' => [
        'theme-type',
        '--gradient-first-color',
        '--gradient-second-color',
        '--gradient-degree',
        '--theme-color',
        '--main-border-color',
        '--text-main',
    ],

    'FONT' => [
        '--font-family'
    ],

    'DEPARTMENTS' => [
        [
            'name' => 'FrontEnd Department',
            'is_hidden' => 0,
            'default' => 0
        ],
        [
            'name' => 'BackEnd Department',
            'is_hidden' => 0,
            'default' => 0
        ],
        [
            'name' => 'Android Department',
            'is_hidden' => 0,
            'default' => 0
        ],
        [
            'name' => 'Sales Department',
            'is_hidden' => 0,
            'default' => 0
        ],
        [
            'name' => 'Support Department',
            'is_hidden' => 0,
            'default' => 0
        ],
        [
            'name' => 'Billing Department',
            'is_hidden' => 0,
            'default' => 0
        ],
        [
            'name' => 'None',
            'is_hidden' => 1,
            'default' => 1
        ],
    ],
    'ROLES' => [
            'admin'     => 'admin',
            'employee'  => 'company',
            'support'   => 'company',
            'leader'    => 'company',
            'user'      => 'web',
    ],
    'PERMISSIONS' => [
        'department'     => 'admin',
        'employee'       => 'admin',
        'user'           => 'admin',
        'setting'        => 'admin',
        'knowledge base' => 'admin',
        'category'       => 'admin',
        'article'        => 'admin',
        'video'          => 'admin',
        'page'           => 'admin',
        'faqs'           => 'admin',
        'permission'     => 'admin',
        'ticket'         => 'admin',
    ],

    'TICKETFILTER' => [
            'all'       => 'ALL',
            'new'       => 'Newest',
            'helpful'   => 'Helpful',
            'viewed'    => 'Most Viewed'
    ],
    'CATEGORIES' => [
        'api'               => 'API Module',
        'cookies'           => 'Cookies Privacy',
        'privacy'           => 'Privacy & Policy',
        'billing'           => 'Billing Module',
        'copyright-legal'   => 'Copyright & Legal',
        'accounting'        => 'Accounting Module',
        'installation'      => 'Installation Module',
        'security_settings' => 'Security Module',
    ],

    'enable_social_login'   => true,
    'enable_google_login'   => true,
    'enable_twitter_login'  => true,
    'enable_facebook_login' => true,
    'SOCIAL_LOGIN_PROVIDER' => ['facebook','google'],

    'LANGUAGE' => [
        'en' => 'English',
        'ar' => 'Arabic'
    ],

    'NOTIFICATION_SETTING' => [
        'MATTERMOST_WEBHOOK_URL' => env('MATTERMOST_WEBHOOK_URL'),
        'SLACK_WEBHOOK_URL' => env('SLACK_WEBHOOK_URL')
    ],

    'BOOLEAN_VARIABLE' => [
        'APP_DEBUG',
        'USE_PERSONAL_TOKEN',
        'EVANTO_LOGIN'
    ]
];
