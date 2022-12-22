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

    public function index()
    {
        return view('settings.index');
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
        foreach ($data as $settingKey => $settingValue) {
            if (is_array($settingValue)) {
                $settingValue = json_encode(array_filter($settingValue), JSON_THROW_ON_ERROR);
            }
            setting()->set($settingKey, (string)$settingValue);
        }
        setting()->save();
    }
}
