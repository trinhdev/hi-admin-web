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
		$listParamNeedProtect = ['password','current_password','password_confirmation'];
		$listParamNeedRemove = ['_token','_pjax'];
		$data = $request->input();
		foreach($listParamNeedRemove as $key){
			if($request->$key){
				unset($data[$key]);
			}
		};
		foreach($listParamNeedProtect as $key){
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