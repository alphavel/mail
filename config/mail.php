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
    | Supported: "smtp", "sendmail", "log"
    |
    */
    'driver' => env('MAIL_DRIVER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Mailer From Address
    |--------------------------------------------------------------------------
    |
    | This email address is used globally for all e-mails that are sent by
    | your application.
    |
    */
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | SMTP Mailer Configuration
    |--------------------------------------------------------------------------
    |
    | Performance: Connection pooling enabled by default
    | Reuses same SMTP connection for multiple emails
    |
    */
    'smtp' => [
        'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
        'port' => env('MAIL_PORT', 587),
        'encryption' => env('MAIL_ENCRYPTION', 'tls'), // tls, ssl, null
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Views Path
    |--------------------------------------------------------------------------
    |
    | Path to email template views.
    | If using view package, this is ignored.
    |
    */
    'views_path' => env('MAIL_VIEWS_PATH', 'views/emails'),
];
