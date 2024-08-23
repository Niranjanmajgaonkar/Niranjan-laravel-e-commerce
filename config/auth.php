<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here, you can define every authentication guard for your application.
    | A great default configuration has been defined for you, which uses
    | session storage and the Eloquent user provider.
    |
    | All authentication guards have a user provider, which defines how the
    | users are retrieved from your database or other storage systems used
    | by the application. Typically, Eloquent is used.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'store' => [
            'driver' => 'session',
            'provider' => 'stores',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider. This defines how the
    | users are retrieved from your database or other storage systems used
    | by the application. Typically, Eloquent is used.
    |
    | You can configure multiple user providers for different models or
    | tables. These providers can then be assigned to any extra
    | authentication guards you've defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Registration::class,
        ],
        'stores' => [
            'driver' => 'eloquent',
            'model' => App\Models\StoreDetail::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | These options specify the behavior of Laravel's password reset
    | functionality, including the table used for token storage and the
    | user provider that is invoked to retrieve users.
    |
    | The expiry time is the number of minutes each reset token will be
    | considered valid. This security feature keeps tokens short-lived
    | so they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens, to prevent abuse.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'stores' => [
            'provider' => 'stores',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here, you can define the amount of seconds before a password
    | confirmation window expires and users are asked to re-enter
    | their password via the confirmation screen.
    | By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
