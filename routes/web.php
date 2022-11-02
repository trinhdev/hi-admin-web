<?php

use App\Http\Controllers\Hi_FPT\AppController;
use App\Http\Controllers\Hi_FPT\PopupPrivateController;
use App\Http\Controllers\Hi_FPT\PopupManageController;
use App\Http\Controllers\Hi_FPT\ResetPasswordWrongController;
use App\Http\Controllers\Hi_FPT\ScreenController;
use App\Http\Controllers\Hi_FPT\DeeplinkController;
use App\Http\Controllers\Hi_FPT\SectionLogController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hi_FPT\FtelPhoneController;
use App\Http\Controllers\Hi_FPT\EmployeesController;
use App\Http\Controllers\Hi_FPT\PaymentController;
use App\Http\Controllers\Hi_FPT\AirDirectionController;
use App\Http\Controllers\Hi_FPT\BehaviorController;
use App\Http\Controllers\Hi_FPT\UpdateEmployeesFromExcelFileController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::group([
    'middleware' => ['auth', 'can:role-permission']
],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::prefix('home')->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
            Route::get('/getDataChart', 'HomeController@getDataChart')->name('home.getDataChart');
            Route::get('/getPaymentErrorTableData', 'HomeController@getPaymentErrorTableData')->name('home.getPaymentErrorTableData');
        });
        Route::prefix('file')->group(function () {
            Route::any('/uploadImageExternal', 'FileController@uploadImageExternal')->name('uploadImageExternalB');

        });
        Route::namespace('Admin')->group(function () {
            Route::prefix('settings')->group(function () {
                Route::get('/', 'SettingsController@index')->name('settings.index');
                Route::get('/edit/{id}', 'SettingsController@edit')->name('settings.edit');
                Route::get('/create', 'SettingsController@create')->name('settings.create');
                Route::post('/store', 'SettingsController@store')->name('settings.store');
                Route::put('/update/{id}', 'SettingsController@update')->name('settings.update');
                Route::delete('/destroy/{id}', 'SettingsController@destroy')->name('settings.destroy');
                Route::get('/initDatatable', 'SettingsController@initDatatable')->name('settings.initDatatable');
            });
            Route::prefix('user')->group(function () {
                Route::get('/', 'UserController@index')->name('user.index');
                Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
                Route::get('/create', 'UserController@create')->name('user.create');
                Route::post('/store', 'UserController@store')->name('user.store');
                Route::put('/update/{id}', 'UserController@update')->name('user.update');
                Route::delete('/destroy/{id}', 'UserController@destroy')->name('user.destroy');
                Route::get('/initDatatable', 'UserController@initDatatable')->name('user.initDatatable');
            });
            Route::prefix('groups')->group(function () {
                Route::get('/', 'GroupsController@index')->name('groups.index');
                Route::get('/edit/{id?}', 'GroupsController@edit')->name('groups.edit');
                Route::get('/create', 'GroupsController@create')->name('groups.create');
                Route::post('/save', 'GroupsController@save')->name('groups.store');
                Route::delete('/destroy/{id}', 'GroupsController@destroy')->name('groups.destroy');
                Route::get('/getList', 'GroupsController@getList')->name('groups.getList');
            });
            Route::prefix('modules')->group(function () {
                Route::get('/', 'ModulesController@index')->name('modules.index');
                Route::get('/edit/{id}', 'ModulesController@edit')->name('modules.edit');
                Route::get('/create', 'ModulesController@create')->name('modules.create');
                Route::post('/store', 'ModulesController@store')->name('modules.store');
                Route::put('/update/{id}', 'ModulesController@update')->name('modules.update');
                Route::delete('/destroy/{id}', 'ModulesController@destroy')->name('modules.destroy');
                Route::get('/initDatatable', 'ModulesController@initDatatable')->name('modules.initDatatable');
            });

            Route::prefix('groupmodule')->group(function () {
                Route::get('/', 'GroupmoduleController@index')->name('groupmodule.index');
                Route::get('/edit/{id}', 'GroupmoduleController@edit')->name('groupmodule.edit');
                Route::get('/create', 'GroupmoduleController@create')->name('groupmodule.create');
                Route::post('/store', 'GroupmoduleController@store')->name('groupmodule.store');
                Route::put('/update/{id}', 'GroupmoduleController@update')->name('groupmodule.update');
                Route::delete('/destroy/{id}', 'GroupmoduleController@destroy')->name('groupmodule.destroy');
                Route::get('/initDatatable', 'GroupmoduleController@initDatatable')->name('groupmodule.initDatatable');
            });
            Route::prefix('roles')->group(function () {
                Route::get('/', 'RolesController@index')->name('roles.index');
                Route::get('/edit/{id?}', 'RolesController@edit')->name('roles.edit');
                Route::get('/create', 'RolesController@create')->name('roles.create');
                Route::post('/save', 'RolesController@save')->name('roles.save');
                Route::delete('/destroy/{id}', 'RolesController@destroy')->name('roles.destroy');
                Route::get('/getList', 'RolesController@getList')->name('roles.getList');
            });

            Route::prefix('logactivities')->group(function () {
                Route::get('/', 'LogactivitiesController@index')->name('logactivities.index');
                Route::post('/clearLog', 'LogactivitiesController@clearLog')->name('logactivities.clearLog');
                Route::delete('/destroy/{id}', 'LogactivitiesController@destroy')->name('logactivities.destroy');
                Route::get('/initDatatable', 'LogactivitiesController@initDatatable')->name('logactivities.initDatatable');
            });

        });
        Route::namespace('Hdi')->group(function () {
            Route::prefix('checklistmanage')->group(function () {
                Route::get('/', 'ChecklistmanageController@index')->name('checklistmanage.index');
                Route::post('/sendStaff', 'ChecklistmanageController@sendStaff')->name('checklistmanage.sendStaff');
                Route::post('/completeChecklist', 'ChecklistmanageController@completeChecklist')->name('checklistmanage.completeChecklist');
            });
            Route::prefix('closehelprequest')->group(function () {
                Route::get('/', 'ClosehelprequestController@index')->name('closehelprequest.index');
                Route::post('/getListReportByContract', 'ClosehelprequestController@getListReportByContract')->name('closehelprequest.getListReportByContract');
                Route::post('/closeRequest', 'ClosehelprequestController@closeRequest')->name('closehelprequest.closeRequest');
            });

            Route::prefix('checkuserinfo')->group(function () {
                Route::get('/{info?}', 'CheckUserInfoController@index')->name('checkuserinfo.index');
                // Route::get('','CheckUserInfoController@checkUserInfo')->name('checkuserinfo.checkUserInfo');
            });

        });
        Route::namespace('Hi_FPT')->group(function () {
            Route::prefix('manageotp')->group(function () {
                Route::get('/', 'ManageotpController@index')->name('manageotp.index');
                Route::get('/handle/{phone?}/{action?}', 'ManageotpController@handle')->name('manageotp.handle');
            });
            Route::prefix('hidepayment')->group(function () {
                Route::get('/', 'HidepaymentController@index')->name('hidepayment.index');
                Route::post('/hide', 'HidepaymentController@hide')->name('hidepayment.hide');
                Route::get('/initDatatable', 'HidepaymentController@initDatatable')->name('hidepayment.initDatatable');
            });
            Route::prefix('modeminfo')->group(function () {
                Route::get('/', 'ModeminfoController@index')->name('modeminfo.index');
                Route::get('/searchByContractNoOrId', 'ModeminfoController@searchByContractNoOrId')->name('modeminfo.searchByContractNoOrId');
                Route::get('/initDatatable', 'ModeminfoController@initDatatable')->name('modeminfo.initDatatable');
            });

            Route::prefix('IpMacOnline')->group(function () {
                Route::get('/', 'ModeminfoController@search')->name('IpMacOnline.index');
                Route::get('/searchByObjId', 'ModeminfoController@searchByObjId')->name('IpMacOnline.searchByObjId');
            });

            Route::prefix('iconmanagement')->group(function () {
                Route::get('/', 'IconmanagementController@index')->name('iconmanagement.index');
                Route::get('/edit/{id?}', 'IconmanagementController@edit')->name('iconmanagement.edit');
                Route::post('/save', 'IconmanagementController@save')->name('iconmanagement.save');
                Route::get('/detail/{id?}', 'IconmanagementController@detail')->name('iconmanagement.detail');
                Route::post('/upload', 'IconmanagementController@upload')->name('iconmanagement.upload');
                Route::post('/destroy', 'IconmanagementController@destroy')->name('iconmanagement.destroy');
                // Route::get('/searchByContractNoOrId','IconmanagementController@searchByContractNoOrId')->name('iconmanagement.searchByContractNoOrId');
                Route::get('/initDatatable', 'IconmanagementController@initDatatable')->name('iconmanagement.initDatatable');
            });

            Route::prefix('iconcategory')->group(function () {
                Route::get('/', 'IconcategoryController@index')->name('iconcategory.index');
                Route::get('/edit/{id?}', 'IconcategoryController@edit')->name('iconcategory.edit');
                Route::post('/save', 'IconcategoryController@save')->name('iconcategory.save');
                Route::get('/detail/{id?}', 'IconcategoryController@detail')->name('iconcategory.detail');
                Route::post('/upload', 'IconcategoryController@upload')->name('iconcategory.upload');
                Route::post('/destroy', 'IconcategoryController@destroy')->name('iconcategory.destroy');
                // Route::get('/searchByContractNoOrId','IconmanagementController@searchByContractNoOrId')->name('iconmanagement.searchByContractNoOrId');
                Route::get('/initDatatable', 'IconcategoryController@initDatatable')->name('iconcategory.initDatatable');
            });

            Route::prefix('iconconfig')->group(function () {
                Route::get('/', 'IconconfigController@index')->name('iconconfig.index');
                Route::get('/edit/{id?}', 'IconconfigController@edit')->name('iconconfig.edit');
                Route::post('/save', 'IconconfigController@save')->name('iconconfig.save');
                Route::get('/detail/{id?}', 'IconconfigController@detail')->name('iconconfig.edit');
                Route::post('/upload', 'IconconfigController@upload')->name('iconconfig.upload');
                Route::post('/destroy', 'IconconfigController@destroy')->name('iconconfig.destroy');
                // Route::get('/searchByContractNoOrId','IconconfigController@searchByContractNoOrId')->name('iconconfig.searchByContractNoOrId');
                Route::get('/initDatatable', 'IconconfigController@initDatatable')->name('iconconfig.initDatatable');
            });

            Route::prefix('iconapproved')->group(function () {
                Route::get('/', 'IconapprovedController@index')->name('iconapproved.index');
                Route::get('/edit/{id?}', 'IconapprovedController@edit')->name('iconapproved.edit');
                Route::post('/save', 'IconapprovedController@save')->name('iconapproved.save');
                Route::get('/detail/{id?}', 'IconapprovedController@detail')->name('iconapproved.detail');
                Route::post('/upload', 'IconapprovedController@upload')->name('iconapproved.upload');
                Route::post('/destroyByApprovedRole', 'IconapprovedController@destroyByApprovedRole')->name('iconapproved.destroyByApprovedRole');
                Route::get('/destroy/{id?}', 'IconapprovedController@destroy')->name('iconapproved.destroy');
                Route::get('/initDatatable', 'IconapprovedController@initDatatable')->name('iconapproved.initDatatable');
            });

            Route::prefix('supportcode')->group(function () {
                Route::get('/', 'SupportCodeController@index')->name('supportcode.index');
                Route::post('/open-support-code', 'SupportCodeController@openSupportCode')->name('supportcode.openSupportCode');
                Route::get('/log', 'SupportCodeController@log')->name('supportcode.log');

            });
            Route::get('/laptop-orders', 'LaptopOrdersController@index')->name('laptop-orders.index');
            Route::post('/laptop-orders', 'LaptopOrdersController@index')->name('laptop-orders.index');

            Route::prefix('helper')->group(function () {
                Route::get('/', 'HelperController@index')->name('helper.index');
                Route::get('/create', 'HelperController@create')->name('helper.create');
                Route::post('/store', 'HelperController@store')->name('helper.store');
                Route::get('/edit/{id?}', 'HelperController@edit')->name('helper.edit');
                Route::put('/update/{id?}', 'HelperController@update')->name('helper.update');
                Route::delete('/destroy/{id?}', 'HelperController@destroy')->name('helper.destroy');

            });
            Route::prefix('supportsystem')->group(function () {
                Route::get('/', 'SupportSystemController@index')->name('supportsystem.index');
                Route::get('/create', 'SupportSystemController@create')->name('supportsystem.create');
                Route::post('/store', 'SupportSystemController@store')->name('supportsystem.store');
                Route::get('/edit/{id?}', 'SupportSystemController@edit')->name('supportsystem.edit');
                Route::put('/update/{id?}', 'SupportSystemController@update')->name('supportsystem.update');
                Route::delete('/destroy/{id?}', 'SupportSystemController@destroy')->name('supportsystem.destroy');

            });

            /*
             * Route Public
             * Create by trinhhdp
            */
            Route::prefix('popupmanage')->group(function () {
                Route::get('/', [PopupManageController::class, 'all'])->name('popupmanage.index');
                Route::post('/save', [PopupManageController::class, 'store'])->name('popupmanage.save');
                Route::get('/view/{id?}', [PopupManageController::class, 'show'])->name('popupmanage.view');
                Route::get('/detail/{id?}', [PopupManageController::class, 'detail'])->name('popupmanage.detail');
                Route::post('/pushPopupTemplate', [PopupManageController::class, 'push'])->name('popupmanage.pushPopupTemplate');
                Route::post('/getDetailPersonalMaps', [PopupManageController::class, 'getDetailPersonalMaps'])->name('popupmanage.getDetailPersonalMaps');
            });

            Route::prefix('popup-private')->group(function () {
                Route::get('/', [PopupPrivateController::class, 'all'])->name('popupmanage.getPrivate');
                Route::get('/getPaginatePrivate', [PopupPrivateController::class, 'paginate'])->name('popupmanage.getPaginatePrivate');
                Route::get('/getByIdPrivate', [PopupPrivateController::class, 'show'])->name('popupmanage.getByIdPrivate');
                Route::post('/addPrivate', [PopupPrivateController::class, 'store'])->name('popupmanage.addPrivate');
                Route::post('/updatePrivate', [PopupPrivateController::class, 'update'])->name('popupmanage.updatePrivate');
                Route::post('/deletePrivate', [PopupPrivateController::class, 'destroy'])->name('popupmanage.deletePrivate');
                Route::post('/importPrivate', [PopupPrivateController::class, 'import'])->name('popupmanage.importPrivate');
                Route::post('/importFilePrivate', [PopupPrivateController::class, 'importFile'])->name('popupmanage.importFilePrivate');
                Route::post('/checkPrivate', [PopupPrivateController::class, 'check'])->name('popupmanage.importPrivate');
            });

            Route::prefix('air-direction')->group(function () {
                Route::get('/', [AirDirectionController::class, 'index'])->name('air_direction.index');
                Route::post('/getById', [AirDirectionController::class, 'getById'])->name('air_direction.getById');
                Route::post('/add', [AirDirectionController::class, 'add'])->name('air_direction.add');
                Route::post('/update', [AirDirectionController::class, 'update'])->name('air_direction.update');
                Route::post('/delete', [AirDirectionController::class, 'delete'])->name('air_direction.delete');
            });

            Route::prefix('payment')->group(function () {
                Route::get('/', [PayMentController::class, 'index'])->name('payment.index');
            });

            Route::prefix('bannermanage')->group(function () {
                Route::get('/', 'BannerController@all')->name('bannermanage.index');
                Route::post('/store', 'BannerController@store')->name('bannermanage.store');
                Route::post('/update/{id}', 'BannerController@update')->name('bannermanage.update');
                Route::post('/updateordering', 'BannerController@update_order')->name('bannermanage.updateOrder');
                Route::get('/show/{id}', 'BannerController@show')->name('bannermanage.view');
            });

            Route::prefix('reset-password-wrong')->group(function () {
                Route::get('/', [ResetPasswordWrongController::class, 'index'])->name('reset_password_wrong.index');
                Route::post('/store', [ResetPasswordWrongController::class, 'store'])->name('reset_password_wrong.store');
            });

            Route::prefix('app')->group(function () {
                Route::get('/', [AppController::class, 'index'])->name('app.index');
                Route::post('/chart', [AppController::class, 'postChart'])->name('app.post.chart');
                Route::get('/export', [AppController::class, 'export'])->name('app.export');
                Route::get('download/{filename}', function ($filename) {
                    return response()->download(public_path('file/' . $filename), $filename);
                });
            });

            Route::prefix('section-log')->group(function () {
                Route::get('/', [SectionLogController::class, 'index'])->name('sectionLog.index');
                Route::get('/store', [SectionLogController::class, 'store'])->name('sectionLog.store');
            });

            Route::prefix('ftel-phone')->group(function () {
                Route::get('/', [FtelPhoneController::class, 'index'])->name('ftel_phone.index');
                Route::get('/create', [FtelPhoneController::class, 'create'])->name('ftel_phone.create');
                Route::post('/store', [FtelPhoneController::class, 'stores'])->name('ftel_phone.store');
                Route::get('/edit/{id}', [FtelPhoneController::class, 'edit'])->name('ftel_phone.edit');
                Route::post('/update/{id}', [FtelPhoneController::class, 'update'])->name('ftel_phone.update');
                Route::post('/check', [FtelPhoneController::class, 'check'])->name('ftel_phone.check');
                Route::post('/import', [FtelPhoneController::class, 'import'])->name('ftel_phone.import');
                Route::get('/initDatatable', [FtelPhoneController::class, 'initDatatable'])->name('ftel_phone.initDatatable');
            });

            Route::prefix('screen')->group(function () {
                Route::get('/', [ScreenController::class, 'index'])->name('screen.index');
                Route::get('/create', [ScreenController::class, 'create'])->name('screen.create');
                Route::post('/store', [ScreenController::class, 'store'])->name('screen.store');
                Route::get('/edit/{id}', [ScreenController::class, 'show'])->name('screen.edit');
                Route::post('/update/{id}', [ScreenController::class, 'update'])->name('screen.update');
                Route::get('/delete/{id}', [ScreenController::class, 'delete'])->name('screen.delete');
            });

            Route::prefix('deeplink')->group(function () {
                Route::get('/', [DeeplinkController::class, 'index'])->name('deeplink.index');
                Route::get('/create', [DeeplinkController::class, 'create'])->name('deeplink.create');
                Route::post('/store', [DeeplinkController::class, 'store'])->name('deeplink.store');
                Route::get('/edit/{id}', [DeeplinkController::class, 'show'])->name('deeplink.edit');
                Route::post('/update/{id}', [DeeplinkController::class, 'update'])->name('deeplink.update');
                Route::get('/delete/{id}', [DeeplinkController::class, 'delete'])->name('deeplink.delete');
            });

            Route::prefix('behavior')->group(function () {
                Route::get('/', [BehaviorController::class, 'index'])->name('behavior.index');
                Route::post('/', [BehaviorController::class, 'index'])->name('behavior.post');
            });

            Route::prefix('employees-updates')->group(function () {
                Route::get('/', [UpdateEmployeesFromExcelFileController::class, 'index'])->name('employees_updates.index');
                Route::get('/create', [UpdateEmployeesFromExcelFileController::class, 'create'])->name('employees_updates.create');
                Route::post('/store', [UpdateEmployeesFromExcelFileController::class, 'stores'])->name('employees_updates.store');
                Route::get('/edit/{id}', [UpdateEmployeesFromExcelFileController::class, 'edit'])->name('employees_updates.edit');
                Route::post('/update/{id}', [UpdateEmployeesFromExcelFileController::class, 'update'])->name('employees_updates.update');
                Route::post('/check', [UpdateEmployeesFromExcelFileController::class, 'check'])->name('employees_updates.check');
                Route::post('/import', [UpdateEmployeesFromExcelFileController::class, 'import'])->name('employees_updates.import');
                Route::get('/initDatatable', [UpdateEmployeesFromExcelFileController::class, 'initDatatable'])->name('employees_updates.initDatatable');
            });

            Route::prefix('unlockdeleteuser')->group(function () {
                Route::get('/', 'UnlockDeleteUserLogsController@index')->name('unlockdeleteuser.index');
                Route::get('/handle/{phone?}', 'UnlockDeleteUserLogsController@handle')->name('unlockdeleteuser.handle');
            });

            Route::prefix('applogfilter')->group(function () {
                Route::get('/', 'AppLogController@index')->name('applogfilter.index');
            });

            Route::prefix('employees')->group(function () {
                Route::get('/', [EmployeesController::class, 'index'])->name('employees.index');
                Route::get('/create', [EmployeesController::class, 'create'])->name('employees.create');
                Route::post('/store', [EmployeesController::class, 'store'])->name('employees.store');
                Route::get('/edit/{id}', [EmployeesController::class, 'edit'])->name('employees.edit');
                Route::put('/update/{id}', [EmployeesController::class, 'update'])->name('employees.update');
            });
        });
        Route::prefix('profile')->group(function () {
            Route::post('/changePassword', 'ProfileController@changePassword')->name('profile.changePassword');
            Route::post('/updateprofile', 'ProfileController@updateprofile')->name('profile.updateprofile');
        });

        Route::namespace('SmsWorld')->group(function () {
            Route::prefix('smsworld')->group(function () {
                Route::any('/{phonecode?}/{phone?}/{date?}', 'OtpController@logs')->name('smsworld.logs');
            });
        });

        Route::namespace('Report')->group(function () {
            Route::prefix('appinstallreport')->group(function () {
                Route::get('/', 'AppinstallreportController@index')->name('appinstallreport.index');
                Route::get('/initDatatableByDate', 'AppinstallreportController@initDatatableByDate')->name('appinstallreport.initDatatableByDate');
                Route::get('/initDatatableByWeek', 'AppinstallreportController@initDatatableByWeek')->name('appinstallreport.initDatatableByWeek');
                Route::get('/initDatatableByMonth', 'AppinstallreportController@initDatatableByMonth')->name('appinstallreport.initDatatableByMonth');
                Route::post('/export', 'AppinstallreportController@export')->name('appinstallreport.export');
            });
            Route::prefix('reportsalebydate')->group(function () {
                Route::get('/', 'SalereportbydateController@index')->name('reportsalebydate.index');
            });
            Route::prefix('reportsalebydatedoanhthu')->group(function () {
                Route::get('/', 'SalereportbydatedoanhthuController@index')->name('reportsalebydatedoanhthu.index');
            });
            Route::prefix('errorpaymentchart')->group(function () {
                Route::get('/', 'ErrorpaymentchartController@index')->name('errorpaymentchart.index');
                Route::post('/getPaymentErrorUserSystem', 'ErrorpaymentchartController@getPaymentErrorUserSystem')->name('errorpaymentchart.getPaymentErrorUserSystem');
                Route::post('/getPaymentErrorDetail', 'ErrorpaymentchartController@getPaymentErrorDetail')->name('errorpaymentchart.getPaymentErrorDetail');
            });
            Route::prefix('laptopordersbyproduct')->group(function () {
                Route::get('/', 'ReportLaptopOrdersByProductController@index')->name('laptopordersbyproduct.index');
            });
            Route::prefix('salereportdatamultiservice')->group(function () {
                $request = $_GET;
                switch(@$request['submitbutton']) {
                    case 'Search':
                        Route::get('/', 'SaleReportDataMultiServiceController@index')->name('salereportdatamultiservice.index');
                        break;
                    case 'Phone export':
                        Route::get('/', 'SaleReportDataMultiServiceController@exportPhoneOnly')->name('salereportdatamultiservice.exportphoneonly');
                        break;
                    case 'All export':
                        Route::get('/', 'SaleReportDataMultiServiceController@exportAll')->name('salereportdatamultiservice.exportall');
                        break;
                    default:
                        Route::get('/', 'SaleReportDataMultiServiceController@index')->name('salereportdatamultiservice.index');
                }
            });
        });
    }
);
