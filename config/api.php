<?php

return [
    'API_CAN_REGISTER'            => env('API_CAN_REGISTER', 0),
    'API_CAN_LOGIN'               => env('API_CAN_LOGIN', 0),
    'API_AUTH_LOG_ENABLED'        => env('API_AUTH_LOG_ENABLED', 1),
    'can_login_denied_message'    => 'Login denied.',
    'can_register_denied_message' => 'Registration denied.',
    'user_registered_message'     => 'User registered',
    'logout_message'              => 'Logged out successfully.',
    'ping_response'               => 'PONG',
    'ping_authorized_response'    => 'PONG AUTHORIZED',
    'name_max_length'             => 255,
    'name_min_length'             => 2,
    'password_max_length'         => 255,
    'password_min_length'         => 8,
    'email_max_length'            => 255
];
