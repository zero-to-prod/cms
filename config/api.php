<?php

return [
    'API_CAN_REGISTER'            => env('API_CAN_REGISTER', 0),
    'API_CAN_LOGIN'               => env('API_CAN_LOGIN', 0),
    'API_AUTH_LOG_ENABLED'        => env('API_AUTH_LOG_ENABLED', 1),
    'can_login_denied_message'    => 'Login denied.',
    'can_register_denied_message' => 'Registration denied.',
    'logout_message'              => 'Logged out successfully.',
    'ping_response'               => 'PONG',
    'ping_authorized_response'    => 'PONG AUTHORIZED',
];
