<?php
$listRedisKey = [
    'MODULE_BY_ROLE_ID' => 'acl_role_module', // acl_role_moduleX , X là role_id
    'SETTINGS' => 'settings',
    'LIST_CHECKLIST_ID' =>'list_check_list_id',
    'CHART_DOANH_THU_BAO_HIEM_HDI' => 'chart_doanh_thu_bao_hiem_hdi_key'
];
return [
    'ADMIN' => 1, // role_id of admin
    'ClEAR_LOG_OPTIONS' => [
        0, 15, 30, 60
    ],
    'REDIS_KEY' => $listRedisKey,
];
