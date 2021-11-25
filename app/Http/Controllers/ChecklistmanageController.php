<?php

namespace App\Http\Controllers;
use App\Services\ContractService;
use App\Services\HelpRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

;

class ChecklistmanageController extends MY_Controller
{
    //
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $listCheckList = $this->getListCheckList();
        return view('checklist.inputContract')->with(['list_checklist_id'=>$listCheckList]);
    }

    public function sendStaff(Request $request)
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
        $list_report_response = $helpReqeustService->updateEmployeeByContract($contract_info); // call api get list report by contract
        $listCheckList = $this->getListCheckList();
        if($list_report_response->statusCode != 0){
            return redirect()->back()->withErrors(['error'=>$list_report_response->message,'list_checklist_id'=>$listCheckList]);
        }
        // continue
        return redirect()->back()->withSuccess(['success'=>'success','list_checklist_id'=>$listCheckList]);
    }

    public function completeChecklist(Request $request)
    {
        if(!$request->ajax()){
            $request->validate([
                'checkListId' =>'required'
            ]);       
            $helpReqeustService = new HelpRequestService();
            $completeChecklist_reponse = $helpReqeustService->completeChecklist($request->checkListId);
            $listCheckList = $this->getListCheckList();
            if($completeChecklist_reponse->statusCode != 0){
                return redirect()->back()->withErrors(['error'=>$completeChecklist_reponse->message,'list_checklist_id'=>$listCheckList]);
            }
            return redirect()->back()->withSuccess(['success'=>'success','list_checklist_id'=>$listCheckList]);
        }
    }
    private function getListCheckList(){
        $keyName = config('constants.REDIS_KEY.LIST_CHECKLIST_ID');
        $list = Redis::command('ZREVRANGE', [$keyName,0,-1]);
        return $list;
    }
}
