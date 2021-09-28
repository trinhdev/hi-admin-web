<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $params;
    public function __contruct(Request $request){
        $this->params = $request->all();
        $this->lang = $this->getLanguage();
    }

    public function apiJsonResponse($code, $data, $message = null){
        return response()->json([
            'statusCode' => $this->configs[$code]['config_code'],
            'message'    => (isset($message)) ? $message : $this->configs[$code]['description_'.$this->lang], 
            'data'       => json_encode($data)
        ]);
    }

    public function getLanguage(){
        if(isset($this->params['lang']) && in_array($this->params['lang'],['vi','en'])){
            $lang = $this->params['lang'];
        }
        else{
            $lang = 'vi';
        }
        return $lang;
    }
}
