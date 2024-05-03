<?php

return [
    'customer-services' => [
        'base_uri' => env('GATEWAY_CUSTOMER'),
    ],
    'driver-services' => [
        'base_uri' => env('GATEWAY_DRIVER'),
    ],
    'merchant-services' => [
        'base_uri' => env('GATEWAY_MERCHANT'),
    ],
];
