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
$methodNewsEventDomain = [
    'GET_LIST_TARGET_ROUTE' => 'provider/tool/get-list-direction',
    'UPLOAD_IMAGE' => 'provider/tool/upload-image',
    'GET_LIST_TYPE_BANNER' => 'provider/tool/banner/get-list-type',
    'CREATE_BANNER'=> 'provider/tool/banner/create',
    'UPDATE_BANNER' => 'provider/tool/banner/update',
    'UPDATE_ORDERING'   => 'provider/tool/banner/update-orderings',
    'GET_LIST_BANNER'       => 'provider/tool/banner/get-list-banner',
    'GET_DETAIL_BANNER'     => 'provider/tool/banner/get-detail-banner',

    // pop up
    'CREATE_TEMPLATE_POPUP' => 'provider/tool/popup/create-template',
    'UPDATE_TEMPLATE_POPUP' => 'provider/tool/popup/update-template',
    'PUSH_POPUP'            => 'provider/tool/popup/push-popup',
    'GET_LIST_POPUP'        => 'provider/tool/popup/list-template',
    'GET_DETAIL_POPUP'      => 'provider/tool/popup/detail-template',
    'UPDATE_PERSONAL_MAP'      => 'provider/tool/popup/update-template-personal-map',
    'GET_DETAIL_PERSONAL_MAP'      => 'provider/tool/popup/detail-template-personal-map',
];
return [
    'DOMAIN_INSIDE' => $methodInsideDomain,
    'DOMAIN_REPORT' => $methodReportDomain,
    'DOMAIN_SMS_WORLD' => $methodSmsWorld,
    'DOMAIN_NEWS_EVENT' =>  $methodNewsEventDomain,
];
