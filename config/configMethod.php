<?php
$methodInsideDomain = [
    'GET_CONTRACT_BY_CONTRACT_NO' => 'GetContractByContractNo',
    'GET_CONTRACT_BY_PHONE_NUMBER' => 'GetListContractByPhoneNum',
];
$methodReportDomain = [
    'GET_LIST_REPORT' => 'report-current-111',
    'CLOSE_REQUEST_BY_REPORT_ID' => 'sync-report-complete-by-list-report-id-not-noti',
    'MY_UPDATE_EMPLOYEE' => 'my-update-employee',
    'MY_UPDATE_COMPLETE_CHECKLIST' => 'my-update-complete-checklist',
];

$methodSmsWorld = [
    'LOGIN' => 'login',
    'CHECK_LOG' => 'checklog',
];
return [
    'DOMAIN_INSIDE' => $methodInsideDomain,
    'DOMAIN_REPORT' => $methodReportDomain,
    'DOMAIN_SMS_WORLD' => $methodSmsWorld,
];
