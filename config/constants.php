<?php
$listRedisKey = [
    'MODULE_BY_ROLE_ID' => 'acl_role_module',
    'SETTINGS' => 'settings',
];
return [
    'ADMIN' => 1, // role_id of admin
    'ClEAR_LOG_OPTIONS' => [
        0, 15, 30, 60
    ],
    'REDIS_KEY' => $listRedisKey,
];
