<?php

namespace App\Http\Controllers;
use App\Services\ContractService;
use App\Services\HelpRequestService;
use Illuminate\Http\Request;;

class ClosehelprequestController extends MY_Controller
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
        $tmp = $helpReqeustService->closeRequestByListReportId([1]);

        $contract_info_response = $contractService->getContractInfo($request); // call api get contract info
        dd($contract_info_response);
        if(empty($contract_info_response->data)){
            return redirect()->back()->withErrors(['error'=>"Hợp đồng không tồn tại!"]);
        }
        $contract_info = $contract_info_response->data[0];
        $list_report_response = $helpReqeustService->getListReportByContract($contract_info); // call api get list report by contract
        if(empty($list_report_response->data)){
            return redirect()->back()->withErrors(['error'=>"Không có yêu cầu hỗ trợ nào!"]);
        }
        // continue
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
        return true;
    }
}
