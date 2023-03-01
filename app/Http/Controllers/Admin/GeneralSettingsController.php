<?php

namespace App\Http\Controllers\Admin;

use App\Contract\Hi_FPT\SettingInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Response\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use Yajra\DataTables\DataTables;
use \stdClass;

use App\Models\Settings;

class GeneralSettingsController extends MY_Controller
{
    /**
     * @var SettingInterface
     */
    protected $settingRepository;

    /**
     * SettingController constructor.
     * @param SettingInterface $settingRepository
     */
    public function __construct(SettingInterface $settingRepository)
    {
        parent::__construct();
        $this->title = 'Settings';
        $this->model = $this->getModel('Settings');
        $this->settingRepository = $settingRepository;
    }

    public function index(Request $request)
    {
        // Get key hi_admin_cron_
        $settings_name = Settings::where('name', 'like', 'hi_admin_cron_'. "%")
            ->where('name', 'like', "%".'_enable')
            ->get()->pluck('name');
        $key = [];
        foreach ($settings_name as $value) {
            $startIndex = strpos($value, 'hi_admin_cron_');
            $service = substr($value, $startIndex);
            $key[] = substr($service, strlen('hi_admin_cron_'), strlen($service) - strlen('hi_admin_cron_') - strlen('_enable'));
        }

        $settings = Settings::where('name', 'not like', 'hi_admin_cron_'. "%")->get()->pluck('value', 'name');

        $group = $request->input('group', '');
        switch ($group) {
            case 'general':
                $title = 'Tổng quan';
                $view = 'settings.includes.general';
                $data = [
                    'setting' => $settings
                ];
                break;
            case 'cronjob':
                $title = 'Email chu kì/Cron Job';
                $view = 'settings.includes.cronjob';
                $data = [
                    'key' => $key
                ];
                break;
            case 'info':
                $title = 'System/Server Info';
                $view = 'settings.includes.information';
                $data = [];
                break;
            case 'misc':
                $title = 'Cài đặt khác';
                $view = 'settings.includes.misc';
                $data = [];
                break;
            default:
                $title = 'Tổng quan';
                $view = 'settings.includes.general';
                $data = [
                    'setting' => $settings
                ];

        }
        return view('settings.list', compact('title', 'view', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \JsonException
     */

    public function postEdit(Request $request)
    {
        $this->saveSettings($request->except([
            '_token',
            'hi_admin_cron_add_key'
        ]));

        $add_key = $request->input('hi_admin_cron_add_key');
        if ($add_key) {
            $email_example = [
                'to'    => 'trinhhdp@fpt.com.vn',
                'cc'    => 'trinhhdp@fpt.com.vn',
                'bcc'   => ' ',
            ];
            $listEmail[] = array_filter($email_example);
            setting()->set('hi_admin_cron_'.$add_key.'_enable', '0')->save();
            setting()->set('hi_admin_cron_'.$add_key.'_list_email', json_encode($listEmail,JSON_THROW_ON_ERROR))->save();
            setting()->set('hi_admin_cron_'.$add_key.'_time', '* * * * *')->save();
        }
        return redirect()->back()->with(['success'=>'Update thành công', 'html'=>'Update thành công']);
    }

    /**
     * @param array $data
     * @throws \JsonException
     */
    protected function saveSettings(array $data)
    {
        $data = convert_email_setting($data);
        foreach ($data as $settingKey => $settingValue) {
            if (is_array($settingValue)) {
                $settingValue = json_encode(array_filter($settingValue), JSON_THROW_ON_ERROR);
            }
            setting()->set($settingKey, (string)$settingValue);
        }
        setting()->save();
    }
}
