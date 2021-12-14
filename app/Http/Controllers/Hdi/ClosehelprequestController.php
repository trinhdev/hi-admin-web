<?php

namespace App\Http\Controllers\Hdi;

use App\Http\Controllers\MY_Controller;
use App\Services\ContractService;
use App\Services\HelpRequestService;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;;

class ClosehelprequestController extends MY_Controller
{
    //
    public function __construct()
    {
        $this->title = 'Close Request';
        parent::__construct();
    }
    public function index()
    {
        return view('helprequest.index');
    }

    public function getListReportByContract(Request $request)
    {
        $request->validate([
            'contractNo' =>'required'
        ]);
        $this->addToLog($request);
        $result = [];
        $contractService = new ContractService();
        $helpReqeustService = new HelpRequestService();
        $contract_info_response = $contractService->getContractInfo($request); // call api get contract info
        if(empty($contract_info_response->data)){
            $result['error'] = "Hợp đồng không tồn tại!";
        }else{
            $contract_info = $contract_info_response->data[0];
            $list_report_response = $helpReqeustService->getListReportByContract($contract_info); // call api get list report by contract
            if(empty($list_report_response->data)){
                $result['error'] = "Không có yêu cầu hỗ trợ nào!";
            }else{
                // continue
                $result['data'] = $list_report_response->data;
                $result['contract'] = $request->contractNo;
            }
        }
        return $result;
        // return view('helprequest.index')->with(['listReport'=>$list_report_response->data]);
    }

    public function closeRequest(Request $request)
    {
        if(!$request->ajax()){
            return false;
        }
        $request->validate([
            'report_id' =>'required'
        ]);
        $helpReqeustService = new HelpRequestService();
        $response = $helpReqeustService->closeRequestByListReportId([$request->report_id]);
        $this->addToLog($request);
        return true;
    }
}
