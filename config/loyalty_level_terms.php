<?php

return [
    'consultant' => [
        'reporting_period_months' => '3',
        'terms' => [
            '1' => [
                'hold' => [
                    'self' => 5000.0
                ],
                'upgrade' => [
                    'self' => 10000.0,
                    'team' => 10000.0
                ]
            ],
            '2' => [
                'hold' => [
                    'self' => 5000.0,
                    'team' => 7000.0
                ],
                'upgrade' => [
                    'self' => 50000.0,
                    'team' => 100000.0
                ]
            ],
            '3' => [
                'hold' => [
                    'self' => 10000.0,
                    'team' => 20000.0
                ]
            ]
        ]
    ],
    'customer' => [
        'reporting_period_months' => '1',
        'terms' => [
            '1' => [
                'upgrade' => 3000.0
            ],
            '2' => [
                'hold' => 3000.0,
                'upgrade' => 5000.0
            ],
            '3' => [
                'hold' => 5000.0
            ]
        ]
    ]
];