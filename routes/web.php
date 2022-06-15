<?php

use App\Http\Controllers\Hi_FPT\AppController;
use App\Http\Controllers\Hi_FPT\PopupManageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hi_FPT\FtelPhoneController;
use App\Http\Controllers\Hi_FPT\PaymentController;
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
    'middleware' => ['auth','can:role-permission']
    ],
    function (){
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::prefix('home')->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
            Route::get('/getDataChart', 'HomeController@getDataChart')->name('home.getDataChart');
        });
        Route::prefix('file')->group(function () {
            Route::any('/uploadImageExternal', 'FileController@uploadImageExternal')->name('uploadImageExternalB');

        });
        Route::namespace('Admin')->group(function () {
            Route::prefix('settings')->group(function () {
                Route::get('/','SettingsController@index')->name('settings.index');
                Route::get('/edit/{id}','SettingsController@edit')->name('settings.edit');
                Route::get('/create','SettingsController@create')->name('settings.create');
                Route::post('/store','SettingsController@store')->name('settings.store');
                Route::put('/update/{id}','SettingsController@update')->name('settings.update');
                Route::delete('/destroy/{id}','SettingsController@destroy')->name('settings.destroy');
                Route::get('/initDatatable','SettingsController@initDatatable')->name('settings.initDatatable');
            });
            Route::prefix('user')->group(function () {
                Route::get('/','UserController@index')->name('user.index');
                Route::get('/edit/{id}','UserController@edit')->name('user.edit');
                Route::get('/create','UserController@create')->name('user.create');
                Route::post('/store','UserController@store')->name('user.store');
                Route::put('/update/{id}','UserController@update')->name('user.update');
                Route::delete('/destroy/{id}','UserController@destroy')->name('user.destroy');
                Route::get('/initDatatable','UserController@initDatatable')->name('user.initDatatable');
            });
            Route::prefix('groups')->group(function () {
                Route::get('/','GroupsController@index')->name('groups.index');
                Route::get('/edit/{id?}','GroupsController@edit')->name('groups.edit');
                Route::get('/create','GroupsController@create')->name('groups.create');
                Route::post('/save','GroupsController@save')->name('groups.store');
                Route::delete('/destroy/{id}','GroupsController@destroy')->name('groups.destroy');
                Route::get('/getList','GroupsController@getList')->name('groups.getList');
            });
            Route::prefix('modules')->group(function () {
                Route::get('/','ModulesController@index')->name('modules.index');
                Route::get('/edit/{id}','ModulesController@edit')->name('modules.edit');
                Route::get('/create','ModulesController@create')->name('modules.create');
                Route::post('/store','ModulesController@store')->name('modules.store');
                Route::put('/update/{id}','ModulesController@update')->name('modules.update');
                Route::delete('/destroy/{id}','ModulesController@destroy')->name('modules.destroy');
                Route::get('/initDatatable','ModulesController@initDatatable')->name('modules.initDatatable');
            });

            Route::prefix('groupmodule')->group(function () {
                Route::get('/','GroupmoduleController@index')->name('groupmodule.index');
                Route::get('/edit/{id}','GroupmoduleController@edit')->name('groupmodule.edit');
                Route::get('/create','GroupmoduleController@create')->name('groupmodule.create');
                Route::post('/store','GroupmoduleController@store')->name('groupmodule.store');
                Route::put('/update/{id}','GroupmoduleController@update')->name('groupmodule.update');
                Route::delete('/destroy/{id}','GroupmoduleController@destroy')->name('groupmodule.destroy');
                Route::get('/initDatatable','GroupmoduleController@initDatatable')->name('groupmodule.initDatatable');
            });
            Route::prefix('roles')->group(function () {
                Route::get('/','RolesController@index')->name('roles.index');
                Route::get('/edit/{id?}','RolesController@edit')->name('roles.edit');
                Route::get('/create','RolesController@create')->name('roles.create');
                Route::post('/save','RolesController@save')->name('roles.save');
                Route::delete('/destroy/{id}','RolesController@destroy')->name('roles.destroy');
                Route::get('/getList','RolesController@getList')->name('roles.getList');
            });

            Route::prefix('logactivities')->group(function () {
                Route::get('/','LogactivitiesController@index')->name('logactivities.index');
                Route::post('/clearLog','LogactivitiesController@clearLog')->name('logactivities.clearLog');
                Route::delete('/destroy/{id}','LogactivitiesController@destroy')->name('logactivities.destroy');
                Route::get('/initDatatable','LogactivitiesController@initDatatable')->name('logactivities.initDatatable');
            });
            Route::prefix('ftel-phone')->group(function () {
                Route::get('/', [FtelPhoneController::class, 'index'])->name('ftel_phone.index');
                Route::get('/create', [FtelPhoneController::class, 'create'])->name('ftel_phone.create');
                Route::post('/store', [FtelPhoneController::class, 'stores'])->name('ftel_phone.store');
                Route::post('/check', [FtelPhoneController::class, 'check'])->name('ftel_phone.check');
                Route::post('/import', [FtelPhoneController::class, 'import'])->name('ftel_phone.import');
                Route::get('/initDatatable', [FtelPhoneController::class, 'initDatatable'])->name('ftel_phone.initDatatable');
            });
        });
        Route::namespace('Hdi')->group(function () {
            Route::prefix('checklistmanage')->group(function () {
                Route::get('/','ChecklistmanageController@index')->name('checklistmanage.index');
                Route::post('/sendStaff','ChecklistmanageController@sendStaff')->name('checklistmanage.sendStaff');
                Route::post('/completeChecklist','ChecklistmanageController@completeChecklist')->name('checklistmanage.completeChecklist');
            });
            Route::prefix('closehelprequest')->group(function () {
                Route::get('/','ClosehelprequestController@index')->name('closehelprequest.index');
                Route::post('/getListReportByContract','ClosehelprequestController@getListReportByContract')->name('closehelprequest.getListReportByContract');
                Route::post('/closeRequest','ClosehelprequestController@closeRequest')->name('closehelprequest.closeRequest');
            });

            Route::prefix('checkuserinfo')->group(function () {
                Route::get('/{info?}','CheckUserInfoController@index')->name('checkuserinfo.index');
                // Route::get('','CheckUserInfoController@checkUserInfo')->name('checkuserinfo.checkUserInfo');
            });

        });
        Route::namespace('Hi_FPT')->group(function () {
            Route::prefix('manageotp')->group(function () {
                Route::get('/','ManageotpController@index')->name('manageotp.index');
                Route::get('/handle/{phone?}/{action?}','ManageotpController@handle')->name('manageotp.handle');
            });
            Route::prefix('hidepayment')->group(function () {
                Route::get('/','HidepaymentController@index')->name('hidepayment.index');
                Route::post('/hide','HidepaymentController@hide')->name('hidepayment.hide');
                Route::get('/initDatatable','HidepaymentController@initDatatable')->name('hidepayment.initDatatable');
            });
            Route::prefix('modeminfo')->group(function () {
                Route::get('/','ModeminfoController@index')->name('modeminfo.index');
                Route::get('/searchByContractNoOrId','ModeminfoController@searchByContractNoOrId')->name('modeminfo.searchByContractNoOrId');
                Route::get('/initDatatable','ModeminfoController@initDatatable')->name('modeminfo.initDatatable');
            });

            Route::prefix('bannermanage')->group(function () {
                Route::get('/','BannerManageController@index')->name('bannermanage.index');
                Route::get('/edit/{id}','BannerManageController@edit')->name('bannermanage.edit');
                Route::get('/create','BannerManageController@create')->name('bannermanage.create');
                Route::post('/store','BannerManageController@store')->name('bannermanage.store');
                Route::put('/update/{id}','BannerManageController@update')->name('bannermanage.update');
                Route::get('/initDatatable','BannerManageController@initDatatable')->name('bannermanage.initDatatable');
                Route::post('/updateordering','BannerManageController@updateOrder')->name('bannermanage.updateOrder');
                Route::get('/view/{id}','BannerManageController@view')->name('bannermanage.view');
            });

            Route::prefix('iconmanagement')->group(function () {
                Route::get('/','IconmanagementController@index')->name('iconmanagement.index');
                Route::get('/edit/{id?}','IconmanagementController@edit')->name('iconmanagement.edit');
                Route::post('/save','IconmanagementController@save')->name('iconmanagement.save');
                Route::get('/detail/{id?}','IconmanagementController@detail')->name('iconmanagement.detail');
                Route::post('/upload','IconmanagementController@upload')->name('iconmanagement.upload');
                Route::post('/destroy','IconmanagementController@destroy')->name('iconmanagement.destroy');
                // Route::get('/searchByContractNoOrId','IconmanagementController@searchByContractNoOrId')->name('iconmanagement.searchByContractNoOrId');
                Route::get('/initDatatable','IconmanagementController@initDatatable')->name('iconmanagement.initDatatable');
            });

            Route::prefix('iconcategory')->group(function () {
                Route::get('/','IconcategoryController@index')->name('iconcategory.index');
                Route::get('/edit/{id?}','IconcategoryController@edit')->name('iconcategory.edit');
                Route::post('/save','IconcategoryController@save')->name('iconcategory.save');
                Route::get('/detail/{id?}','IconcategoryController@detail')->name('iconcategory.detail');
                Route::post('/upload','IconcategoryController@upload')->name('iconcategory.upload');
                Route::post('/destroy','IconcategoryController@destroy')->name('iconcategory.destroy');
                // Route::get('/searchByContractNoOrId','IconmanagementController@searchByContractNoOrId')->name('iconmanagement.searchByContractNoOrId');
                Route::get('/initDatatable','IconcategoryController@initDatatable')->name('iconcategory.initDatatable');
            });

            Route::prefix('iconconfig')->group(function () {
                Route::get('/','IconconfigController@index')->name('iconconfig.index');
                Route::get('/edit/{id?}','IconconfigController@edit')->name('iconconfig.edit');
                Route::post('/save','IconconfigController@save')->name('iconconfig.save');
                Route::get('/detail/{id?}','IconconfigController@detail')->name('iconconfig.edit');
                Route::post('/upload','IconconfigController@upload')->name('iconconfig.upload');
                Route::post('/destroy','IconconfigController@destroy')->name('iconconfig.destroy');
                // Route::get('/searchByContractNoOrId','IconconfigController@searchByContractNoOrId')->name('iconconfig.searchByContractNoOrId');
                Route::get('/initDatatable','IconconfigController@initDatatable')->name('iconconfig.initDatatable');
            });

            Route::prefix('iconapproved')->group(function () {
                Route::get('/','IconapprovedController@index')->name('iconapproved.index');
                Route::get('/edit/{id?}','IconapprovedController@edit')->name('iconapproved.edit');
                Route::post('/save','IconapprovedController@save')->name('iconapproved.save');
                Route::get('/detail/{id?}','IconapprovedController@detail')->name('iconapproved.detail');
                Route::post('/upload','IconapprovedController@upload')->name('iconapproved.upload');
                Route::post('/destroy','IconapprovedController@destroy')->name('iconapproved.destroy');
                Route::get('/initDatatable','IconapprovedController@initDatatable')->name('iconapproved.initDatatable');
            });

            Route::prefix('popupmanage')->group(function () {
                Route::get('/', [PopupManageController::class, 'index'])->name('popupmanage.index');
                Route::get('/edit/{id?}',[PopupManageController::class, 'edit'])->name('popupmanage.edit');
                Route::get('/create',[PopupManageController::class, 'edit'])->name('popupmanage.create');
                Route::post('/save',[PopupManageController::class, 'save'])->name('popupmanage.save');
                Route::get('/view/{id?}',[PopupManageController::class, 'view'])->name('popupmanage.view');
                Route::get('/detail/{id?}',[PopupManageController::class, 'detail'])->name('popupmanage.detail');
                Route::post('/pushPopupTemplate',[PopupManageController::class, 'pushPopupTemplate'])->name('popupmanage.pushPopupTemplate');
                Route::post('/getDetailPersonalMaps',[PopupManageController::class, 'getDetailPersonalMaps'])->name('popupmanage.getDetailPersonalMaps');
            });

            Route::prefix('supportcode')->group(function () {
                Route::get('/','SupportCodeController@index')->name('supportcode.index');
                Route::post('/open-support-code','SupportCodeController@openSupportCode')->name('supportcode.openSupportCode');

            });
            Route::prefix('app')->group(function () {
                Route::get('/', [AppController::class, 'index'])->name('app.index');
            });
            Route::prefix('payment')->group(function () {
                Route::get('/', [PayMentController::class, 'index'])->name('payment.index');
            });
        });
        Route::prefix('profile')->group(function () {
            Route::post('/changePassword','ProfileController@changePassword')->name('profile.changePassword');
            Route::post('/updateprofile','ProfileController@updateprofile')->name('profile.updateprofile');
        });

        Route::namespace('SmsWorld')->group(function () {
            Route::prefix('smsworld')->group(function () {
                Route::any('/{phonecode?}/{phone?}/{date?}','OtpController@logs')->name('smsworld.logs');
            });
        });

        Route::namespace('Report')->group(function() {
            Route::prefix('appinstallreport')->group(function() {
                Route::get('/', 'AppinstallreportController@index')->name('appinstallreport.index');
                Route::get('/initDatatableByDate','AppinstallreportController@initDatatableByDate')->name('appinstallreport.initDatatableByDate');
                Route::get('/initDatatableByWeek','AppinstallreportController@initDatatableByWeek')->name('appinstallreport.initDatatableByWeek');
                Route::get('/initDatatableByMonth','AppinstallreportController@initDatatableByMonth')->name('appinstallreport.initDatatableByMonth');
                Route::post('/export','AppinstallreportController@export')->name('appinstallreport.export');
            });
        });
    }
);
