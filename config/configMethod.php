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
    'CREATE_BANNER' => 'provider/tool/banner/create',
    'UPDATE_BANNER' => 'provider/tool/banner/update',
    'UPDATE_ORDERING' => 'provider/tool/banner/update-orderings',
    'GET_LIST_BANNER' => 'provider/tool/banner/get-list-banner',
    'GET_DETAIL_BANNER' => 'provider/tool/banner/get-detail-banner',

    // pop up
    'CREATE_TEMPLATE_POPUP' => 'provider/tool/popup/create-template',
    'UPDATE_TEMPLATE_POPUP' => 'provider/tool/popup/update-template',
    'PUSH_POPUP' => 'provider/tool/popup/push-popup',
    'GET_LIST_POPUP' => 'provider/tool/popup/list-template',
    'GET_DETAIL_POPUP' => 'provider/tool/popup/detail-template',
    'UPDATE_PERSONAL_MAP' => 'provider/tool/popup/update-template-personal-map',
    'GET_DETAIL_PERSONAL_MAP' => 'provider/tool/popup/detail-template-personal-map',
];
$methodHr = [
    'LOGIN' => 'api/services/hub/Login',
    'GET_EMPLOYEE_INFO' => 'api/services/app/hifpt/GetEmployeeInfo',
    'GET_LIST_EMPLOYEE_INFO' => 'api/services/app/hifpt/GetListEmployeeInfo',
];

$methodAuth = [
    'RESET_CODE_SUPPORT' => 'provider/cms/customers/reset-device-lock-by-code',
    'FIND_LIKE_CODE' => 'provider/cms/customers/find-like-code',
    'RESET_LIMIT_OTP' => 'provider/cms/customers/reset-limit-otp',
];

$methodPayment = [
    'GET_TRANSACTION_BY_PHONE' => 'payment-merchant/provider/order/list'
];

$methodPopUpPrivate = [
    'GET' => 'hi-customer-local/tool/popup/get-all',
    'GET_BY_ID' => 'hi-customer-local/tool/popup/get-by-id',
    'GET_PAGINATE' => 'hi-customer-local/tool/popup/get-with-page',
    'ADD' => 'hi-customer-local/tool/popup/add',
    'UPDATE' => 'hi-customer-local/tool/popup/update',
    'DELETE' => 'hi-customer-local/tool/popup/delete',
    'IMPORT' => 'hi-customer-local/tool/popup/import-phone-list',
];
return [
    'DOMAIN_INSIDE'         => $methodInsideDomain,
    'DOMAIN_REPORT'         => $methodReportDomain,
    'DOMAIN_SMS_WORLD'      => $methodSmsWorld,
    'DOMAIN_NEWS_EVENT'     => $methodNewsEventDomain,
    'DOMAIN_HR'             => $methodHr,
    'DOMAIN_AUTH'           => $methodAuth,
    'DOMAIN_PAYMENT'        => $methodPayment,
    'DOMAIN_POPUP_PRIVATE'  => $methodPopUpPrivate,
];
