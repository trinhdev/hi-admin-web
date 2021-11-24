<?php

namespace App\Http\Controllers;
use App\Services\ContractService;
use App\Services\HelpRequestService;
use Illuminate\Http\Request;;

class ChecklistmanageController extends MY_Controller
{
    //
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        return view('checklist.inputContract');
    }

    public function sendStaff(Request $request)
    {
        $request->validate([
            'contractNo' =>'required'
        ]);
        
        $contractService = new ContractService();
        $helpReqeustService = new HelpRequestService();
        $tmp = $helpReqeustService->closeRequestByListReportId([1]);

        $contract_info_response = $contractService->getContractInfo($request); // call api get contract info
        if(empty($contract_info_response->data)){
            return redirect()->back()->withErrors(['error'=>"Hợp đồng không tồn tại!"]);
        }
        $contract_info = $contract_info_response->data[0];
        $list_report_response = $helpReqeustService->updateEmployeeByContract($contract_info); // call api get list report by contract
        if($list_report_response->statusCode != 0){
            return redirect()->back()->withErrors(['error'=>$list_report_response->message]);
        }
        // continue
        return redirect()->back()->withSuccess('success');
    }

    public function completeChecklist(Request $request)
    {
        if(!$request->ajax()){
            $request->validate([
                'checkListId' =>'required'
            ]);
            
            $helpReqeustService = new HelpRequestService();
            $completeChecklist_reponse = $helpReqeustService->completeChecklist($request->checkListId);
            if($completeChecklist_reponse->statusCode != 0){
                return redirect()->back()->withErrors(['error'=>$completeChecklist_reponse->message]);
            }
            return redirect()->back()->withSuccess('success');
        }
    }
}
