<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send any email
    | messages sent by your application. Alternative mailers may be setup
    | and used as needed; however, this mailer will be used by default.
    |
    */

    'api_url' => env('RAHISISHA_API', null),
    'username' => env('RAHISISHA_API_USER', null),
    'password' => env('RAHISISHA_API_PASSWORD', null),
    'sender_id' => env('SENDER_ID', null),
];
