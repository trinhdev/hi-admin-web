<?php
$methodInsideDomain = [
    'GET_CONTRACT_BY_NUMBER' => 'GetContractByContractNo',
];
$methodReportDomain =[
    'GET_LIST_REPORT' => 'report-current-111',
    'CLOSE_REQUEST_BY_REPORT_ID' => 'sync-report-complete-by-list-report-id-not-noti',
];
return [
    'DOMAIN_INSIDE' => $methodInsideDomain,
    'DOMAIN_REPORT' => $methodReportDomain,
];