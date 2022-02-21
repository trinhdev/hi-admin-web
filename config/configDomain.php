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

$domainModemInfo = [
    'local'             => [
        'URL'           => 'http://hi-modem-stag.fpt.vn/',
        'CLIENT_KEY'    => 'hifpt_modem',
        'SECRET_KEY'    => 'xxxxxxhifpt2018',
        'SUB_DOMAIN'    => ['provider', 'admin-tool'],
    ],
    'staging'           => [
        'URL'           => 'http://hi-modem-stag.fpt.vn/',
        'CLIENT_KEY'    => 'hifpt_modem',
        'SECRET_KEY'    => 'xxxxxxhifpt2018',
        'SUB_DOMAIN'    => ['provider', 'admin-tool'],
    ],
    'production'        => [
        'URL'           => 'http://hi-modem.fpt.vn/',
        'CLIENT_KEY'    => 'hifpt_modem',
        'SECRET_KEY'    => 'xxxxxxhifpt2018',
        'SUB_DOMAIN'    => ['provider', 'admin-tool'],
    ],
];

$domainModemAccessPoint = [
    'local'             => [
        'URL'           => 'http://staging-hi-api.fpt.vn/',
        'SUB_DOMAIN'    => ['v68'],
    ],
    'staging'           => [
        'URL'           => 'http://staging-hi-api.fpt.vn/',
        'SUB_DOMAIN'    => ['v68'],
    ],
    'production'        => [
        'URL'           => 'http://hi-api.fpt.vn/',
        'SUB_DOMAIN'    => ['v68'],
    ],
];

$domainModemContractInfo = [
    'local'             => [
        'URL'           => 'http://hi-inside.fpt.vn/',
        'SUB_DOMAIN'    => ['v1'],
        'CLIENT_KEY'    => 'hifpt_inside',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'staging'           => [
        'URL'           => 'http://hi-inside.fpt.vn/',
        'SUB_DOMAIN'    => ['v1'],
        'CLIENT_KEY'    => 'hifpt_inside',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'production'        => [
        'URL'           => 'http://hi-inside.fpt.vn/',
        'SUB_DOMAIN'    => ['v1'],
        'CLIENT_KEY'    => 'hifpt_inside',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
];
<<<<<<< HEAD

$domainIconManagement = [
    'local'             => [
        'URL'           => 'http://hi-customer-stag.fpt.vn/',
        'SUB_DOMAIN'    => ['hi-customer-local', 'tool'],
        'CLIENT_KEY'    => 'hifpt_customer_local',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'staging'           => [
        'URL'           => 'http://hi-customer-stag.fpt.vn/',
        'SUB_DOMAIN'    => ['hi-customer-local', 'tool'],
        'CLIENT_KEY'    => 'hifpt_customer_local',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
    'production'        => [
        'URL'           => 'http://hi-customer-stag.fpt.vn/',
        'SUB_DOMAIN'    => ['hi-customer-local', 'tool'],
        'CLIENT_KEY'    => 'hifpt_customer_local',
        'SECRET_KEY'    => 'xxxxxxhifpt2018'
    ],
];

=======
$domainHr = [
    'local'             => [
        'URL'           => 'http://hrapi.fpt.vn/',
        'USERNAME'    => 'hifpt@hr.fpt.vn',
        'PASSWORD'    => '!@#hiFPT123'
    ],
    'staging'           => [
        'URL'           => 'http://hrapi.fpt.vn/',
        'USERNAME'    => 'hifpt@hr.fpt.vn',
        'PASSWORD'    => '!@#hiFPT123'
    ],
    'production'        => [
        'URL'           => 'http://hrapi.fpt.vn/',
        'USERNAME'    => 'hifpt@hr.fpt.vn',
        'PASSWORD'    => '!@#hiFPT123'
    ],
];
>>>>>>> b43e3e89629ae33330f2909dce743867ce872a5e
return [
    'DOMAIN_REPORT'         => $domainReportConfig,
    'DOMAIN_INSIDE'         => $domainInsideConfig,
    'DOMAIN_CUSTOMER'       => $domainCustomerConfig,
    'DOMAIN_SMS_WORLD'      => $domainSmsWorld,
    'DOMAIN_NEWS_EVENT'     => $domainNewsEventConfig,
    'DOMAIN_MODEM_INFO'             => $domainModemInfo,
    'DOMAIN_MODEM_ACCESS_POINT'     => $domainModemAccessPoint,
    'DOMAIN_MODEM_CONTRACT_INFO'    => $domainModemContractInfo,
<<<<<<< HEAD
    'DOMAIN_ICON_MANAGEMENT'        => $domainIconManagement
=======
    'DOMAIN_HR'             => $domainHr
>>>>>>> b43e3e89629ae33330f2909dce743867ce872a5e
];
