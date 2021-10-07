<?php

namespace App\Http\Controllers;

use App\Models\AdminConfigs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $lang;
    protected $params;
    protected $configs;
    public function __construct(Request $request){
        $this->params = $request->all();
        $this->lang = $this->getLanguage();
        $config = new AdminConfigs();
        $this->configs = $config->getConfigs();
    }

    public function apiJsonResponse($code, $data, $message = null){
        return response()->json([
            'statusCode' => $this->configs[$code]['config_code'],
            'message'    => (isset($message)) ? $message : $this->configs[$code]['description_'.$this->lang], 
            'data'       => $data
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
