<?php
$domainReportConfig = [
    'local'             => [
        'URL'           => 'http://hi-report-stag.fpt.vn/',
        'VERSION'       => 'v10',
        'CLIENT_KEY'    => 'hifpt_report',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'staging'           => [
        'URL'           => 'http://hi-report-stag.fpt.vn/',
        'VERSION'       => 'v10',
        'CLIENT_KEY'    => 'hifpt_report',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'production'        => [
        'URL'           => 'http://hi-report.fpt.vn/',
        'VERSION'       => 'v10',
        'CLIENT_KEY'    => 'hifpt_report',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
];

$domainInsideConfig = [
    'local'             => [
        'URL'           => 'http://hi-inside.fpt.vn/',
        'VERSION'       => 'v1',
        'CLIENT_KEY'    => 'hifpt_inside',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'staging'           => [
        'URL'           => 'http://hi-inside.fpt.vn/',
        'VERSION'       => 'v1',
        'CLIENT_KEY'    => 'hifpt_inside',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'production'        => [
        'URL'           => 'http://hi-inside.fpt.vn/',
        'VERSION'       => 'v1',
        'CLIENT_KEY'    => 'hifpt_inside',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
];

$domainCustomerConfig = [
    'local'             => [
        'URL'           => 'http://hi-customer-stag.fpt.vn/',
        'CLIENT_KEY'    => 'hifpt_customer_local',
        'SUB_DOMAIN'    => ['hi-customer-local', 'swagger'],
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'staging'           => [
        'URL'           => 'http://hi-customer-stag.fpt.vn/',
        'CLIENT_KEY'    => 'hifpt_customer_local',
        'SUB_DOMAIN'    => ['hi-customer-local', 'swagger'],
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'production'        => [
        'URL'           => 'http://hi-customer.fpt.vn/',
        // 'URL'           => 'http://hi-customer-stag.fpt.vn/',
        'CLIENT_KEY'    => 'hifpt_customer_local',
        'SUB_DOMAIN'    => ['hi-customer-local', 'swagger'],
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
];

$domainSmsWorld = [
    'local'             => [
        'URL'           => 'http://smsworld.fpt.vn/',
        'PREFIX'       => 'api',
    ],
    'staging'           => [
        'URL'           => 'http://smsworld.fpt.vn/',
        'PREFIX'       => 'api',
    ],
    'production'        => [
        'URL'           => 'http://smsworld.fpt.vn/',
        'PREFIX'       => 'api',
    ],
];

$domainNewsEventConfig = [
    'local'             => [
        'URL'           => 'hi-news-event-stag.fpt.vn/',
        'CLIENT_KEY'    => '9895ee2f7616a73ab8be47e5df5a8924',
        'SECRET_KEY'    => 'e063d2833da02c8dac4cac106b825535',
    ],
    'staging'           => [
        'URL'           => 'hi-news-event-stag.fpt.vn/',
        'CLIENT_KEY'    => '9895ee2f7616a73ab8be47e5df5a8924',
        'SECRET_KEY'    => 'e063d2833da02c8dac4cac106b825535',
    ],
    'production'        => [
        'URL'           => 'hi-news-event.fpt.vn/',
        'CLIENT_KEY'    => '9895ee2f7616a73ab8be47e5df5a8924',
        'SECRET_KEY'    => 'e063d2833da02c8dac4cac106b825535',
    ],
];
return [
    'DOMAIN_REPORT'         => $domainReportConfig,
    'DOMAIN_INSIDE'         => $domainInsideConfig,
    'DOMAIN_CUSTOMER'       => $domainCustomerConfig,
    'DOMAIN_SMS_WORLD'      => $domainSmsWorld,
    'DOMAIN_NEWS_EVENT'     => $domainNewsEventConfig,
];
