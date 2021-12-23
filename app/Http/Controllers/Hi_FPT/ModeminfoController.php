<?php
namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use App\Services\ModemService;
use Yajra\DataTables\DataTables;

class ModeminfoController extends MY_Controller {
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Modem Info';
        // $this->model = $this->getModel('Hidepayments');
    }

    public function index() {
        return view('modeminfo.index');
    }

    public function getContractIdByContractNo($contractNo) {
        $contractInfo = json_decode(json_encode(ModemService::getContractByContractNo($contractNo)), true);
        $contractId = 0;
        if(isset($contractInfo['code']) && $contractInfo['code'] == 0) {
            $contractId = intval($contractInfo['data'][0]['Id']);
        }
        return $contractId;
    }

    public function searchByContractNoOrId(Request $request) {
        $validated = $request->validate([
            'modemNo' => 'required',
        ]);
        if(is_numeric($request->modemNo)) {
            $contractId = $request->modemNo;
        }
        else {
            $contractId = $this->getContractIdByContractNo($request->modemNo);
        }
        
        $modemInfo = json_decode(json_encode(ModemService::getModemInfo($contractId)), true);
        $response = (!empty($modemInfo['data'])) ? $modemInfo['data'] : [];
        return view('modeminfo.index')->with('data', $response);
    }
}