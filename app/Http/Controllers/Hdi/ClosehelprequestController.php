<?php

namespace App\Http\Controllers\Hdi;

use App\Http\Controllers\MY_Controller;
use App\Services\ContractService;
use App\Services\HelpRequestService;
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
        
        $contractService = new ContractService();
        $helpReqeustService = new HelpRequestService();
        $contract_info_response = $contractService->getContractInfo($request); // call api get contract info
        if(empty($contract_info_response->data)){
            return redirect()->back()->withErrors(['error'=>"Hợp đồng không tồn tại!"]);
        }
        $contract_info = $contract_info_response->data[0];
        $list_report_response = $helpReqeustService->getListReportByContract($contract_info); // call api get list report by contract
        if(empty($list_report_response->data)){
            return redirect()->back()->withErrors(['error'=>"Không có yêu cầu hỗ trợ nào!"]);
        }
        // continue
        $this->addToLog($request);
        return view('helprequest.list_request')->with(['listReport'=>$list_report_response->data]);
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
        $reponse = $helpReqeustService->closeRequestByListReportId([$request->report_id]);
        $this->addToLog($request);
        return true;
    }
}
