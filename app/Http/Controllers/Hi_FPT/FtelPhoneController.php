<?php

namespace App\Http\Controllers\Hi_FPT;

use Carbon\Carbon;
use App\Models\FtelPhone;
use App\Services\HrService;
use Illuminate\Http\Request;
use App\Http\Traits\DataTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MY_Controller;
use App\Http\Requests\FtelPhoneRequest;
use Illuminate\Support\Facades\Validator;

class FtelPhoneController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Phone';
        $this->model = $this->getModel('FtelPhone');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ftel-phone.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ftel-phone.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FtelPhoneRequest $request)
    {
        $arrPhone = explode(',',$request->number_phone);
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        foreach($arrPhone as $arPhone)
        {
            $phone = trim($arPhone);
            $issetPhone = $this->model->where('number_phone',$phone)->first();
            if(!empty($issetPhone) && now()->subWeeks() >= $issetPhone->updated_at) {
                $getInfo = $hrService->getInfoEmployee($phone,$token);
                $issetPhone->update([
                    'number_phone'=> $phone,
                    'code' => $getInfo->code,
                    'emailAddress' => $getInfo->emailAddress,
                    'fullName'=> $getInfo->fullName,
                    'response' => json_encode($getInfo),
                    'organizationNamePath' => $getInfo->organizationNamePath, 
                    'organizationCodePath' => $getInfo->organizationCodePath
                ]);
            } else {
                $getInfo = $hrService->getInfoEmployee($phone,$token);
                if(!empty($getInfo)) {
                    $obj = [
                        'number_phone'=> $phone,
                        'code' => $getInfo->code,
                        'emailAddress' => $getInfo->emailAddress,
                        'fullName'=> $getInfo->fullName,
                        'response' => json_encode($getInfo),
                        'organizationNamePath' => $getInfo->organizationNamePath, 
                        'organizationCodePath' => $getInfo->organizationCodePath
                    ];
                    $code = $this->model->where('code',$getInfo->code)->first();
                    if(!empty($code)) {
                            $code->update($obj);
                    }
                    elseif(empty($issetPhone)) {
                        $obj['created_by'] = $user->id;
                        $this->model->create($obj);
                    }               
                } else {                
                    $this->model->create([
                        'number_phone'=> $phone,
                        'created_by' => Auth::user()->id
                    ]);
                }
            }    
        }
        return redirect()->back()->withSuccess('All success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function initDatatable(Request $request){
        if($request->ajax()){
            $data = $this->model::query();
            return  DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return view('layouts.button.action')->with(['row'=>$row,'module'=>'ftel_phone']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
