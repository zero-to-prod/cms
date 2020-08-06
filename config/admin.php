<?php

return [
    'name'             => env('ADMIN_NAME', 'admin'),
    'email'            => env('ADMIN_EMAIL', 'admin@zero-to-prod.com'),
    'password'         => env('ADMIN_PASSWORD', '123456789'),
    'apply_all_scopes' => env('ADMIN_APPLY_ALL_SCOPES', 1)
];
