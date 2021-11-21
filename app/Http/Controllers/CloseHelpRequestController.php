<?php

namespace App\Http\Controllers;
use App\Services\ContractService;
use App\Services\HelpRequestService;
use Illuminate\Http\Request;;

class CloseHelpRequestController extends MY_Controller
{
    //
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        return view('helprequest.inputContract');
    }

    public function getListReportByContract(Request $request)
    {
        $request->validate([
            'contractNo' =>'required'
        ]);
        
        $contractService = new ContractService();
        $helpReqeustService = new HelpRequestService();
        $contract_info_response = $contractService->getContractInfo($request);
        if(empty($contract_info_response->data)){
            return redirect()->back()->withErrors(['error'=>"Hợp đồng không tồn tại!"]);
        }
        $contract_info = $contract_info_response->data[0];
        $list_report_response = $helpReqeustService->getListReportByContract($contract_info);
        if(empty($list_report_response->data)){
            return redirect()->back()->withErrors(['error'=>"Không có yêu cầu hỗ trợ nào!"]);
        }
        
        return view('helprequest.list_request')->with(['data'=>$list_report_response->data]);
    }

    public function closeHelpRequest(Request $request)
    {

    }
}
