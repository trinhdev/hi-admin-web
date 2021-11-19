<?php

namespace App\Http\Controllers;

use App\Helpers\CallApiHelper;
use App\Http\Controllers\Controller;
use App\Services\ContractService;
use Illuminate\Http\Request;

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
        $contract_info_response = $contractService->getContractInfo($request);
        if(empty($contract_info_response->data)){
            return redirect()->back()->withErrors(['error'=>"Không có yêu cầu hỗ trợ nào!"]);
        }
        return view('helprequest.list_request')->with(['data'=>$contract_info_response->data]);
    }

    public function closeHelpRequest(Request $request)
    {

    }
}
