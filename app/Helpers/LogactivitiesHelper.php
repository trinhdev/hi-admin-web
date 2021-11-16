<?php


namespace App\Helpers;

use App\Models\Log_activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogactivitiesHelper
{
    public static function addToLog(Request $request)
    {
    	$log = [];
    	$log['subject'] = !empty($request->input()) ? json_encode($request->input()) : 'NULL';
    	$log['url'] = request()->url();
    	$log['method'] = request()->method();
    	$log['ip'] = request()->ip();
    	$log['agent'] = request()->header('user-agent');
    	$log['user_id'] = Auth::check() ? Auth::user()->id : 1;
    	// LogActivityModel::create($log);
        Log_activities::create($log);

    }


    public static function logActivityLists()
    {
    	return Log_activities::latest()->get();
    }


}