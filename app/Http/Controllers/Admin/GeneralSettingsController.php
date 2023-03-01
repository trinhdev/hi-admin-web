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
        // Define the keys to be searched for
        $keys_to_find = ['_email_bcc', '_email_cc', '_email_to'];

// Initialize arrays for storing found keys and email addresses
        $found_keys = [];
        $list_email = [];

// Loop through the input data
        foreach ($data as $key => $value) {
            // Check if the key contains one of the keys to be searched for
            foreach ($keys_to_find as $search_key) {
                if (strpos($key, $search_key) !== false) {
                    // Store the key and its value in the found keys array
                    $found_keys[$key] = $value;
                }
            }
        }

// Initialize an array for storing the new keys
        $new_keys = [];

// Loop through the found keys and create new keys with "_list_email" instead of "_email_to", "_email_cc", or "_email_bcc"
        foreach ($found_keys as $k => $v) {
            $new_key = str_replace("_email_to", "_list_email", $k);
            $new_key = str_replace("_email_cc", "_list_email", $new_key);
            $new_key = str_replace("_email_bcc", "_list_email", $new_key);

            // Add the value to the new keys array
            $new_keys[$new_key][] = $v;
        }

// Initialize an array for storing the email addresses in JSON format
        $email_list = [];

// Loop through the new keys and create an email object for each one
        foreach ($new_keys as $k => $v) {
            $email = [
                'to' => $v[0] ?? null, // If to address is not set, set null
                'cc' => $v[1] ?? null, // If cc address is not set, set null
                'bcc' => $v[2] ?? null, // If bcc address is not set, set null
            ];

            // Add the email object to the email list array in JSON format
            $email_list[$k] = json_encode([$email]);
        }

// Merge the original data array with the new keys array and email list array
        $data = array_merge(array_diff($data, $found_keys), $email_list);
dd($data);
        foreach ($data as $settingKey => $settingValue) {
            if (is_array($settingValue)) {
                $settingValue = json_encode(array_filter($settingValue), JSON_THROW_ON_ERROR);
            }
            setting()->set($settingKey, (string)$settingValue);
        }
        setting()->save();
    }
}
