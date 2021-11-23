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
        'SECRET_KEy'    => 'xxxxxxhifpt2018'
    ],
    'production'        => [
        'URL'           => 'http://hi-customer.fpt.vn/',
        // 'URL'           => 'http://hi-customer-stag.fpt.vn/',
        'CLIENT_KEY'    => 'hifpt_customer_local',
        'SUB_DOMAIN'    => ['hi-customer-local', 'swagger'],
        'SECRET_KEy'    => 'xxxxxxhifpt2018'
    ],
];

return [
    'DOMAIN_REPORT'         => $domainReportConfig,
    'DOMAIN_INSIDE'         => $domainInsideConfig,
    'DOMAIN_CUSTOMER'       => $domainCustomerConfig,
];
