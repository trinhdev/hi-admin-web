<?php


namespace App\Helpers;

use App\Models\Log_activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogactivitiesHelper
{
	public static function addToLog(Request $request)
    {
		$tmpStr = '******';
		$listNeedProtect = ['password','current_password','password_confirmation'];
		$data = $request->input();
		foreach($listNeedProtect as $key){
			if($request->$key){
				$data[$key] = $tmpStr;
			}
		};
    	$log = [];
    	$log['param'] = !empty($data) ? json_encode($data) : '';
    	$log['url'] = request()->url();
    	$log['method'] = request()->method();
    	$log['ip'] = request()->ip();
    	$log['agent'] = request()->header('user-agent');
    	$log['user_id'] = Auth::check() ? Auth::user()->id : 1;
        Log_activities::create($log);
    }
}