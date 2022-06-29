<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\AirDirectionDataTable;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\AirDirectionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Matrix\Exception;

class AirDirectionController extends MY_Controller
{
    use DataTrait;

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Air Direction Manage';
    }

    public function index(AirDirectionDataTable $dataTable, Request $request)
    {
        return $dataTable->render('air-direction.index');
    }

    public function add(Request $request)
    {
        $rules = [
            'name'              =>'required',
            'decription'       =>'required',
            'value'             =>'required',
        ];
        $message = [
            'name.required'             => 'Tên điều hướng không được bỏ trống!',
            'decription.required'      => 'Mô tả điều hướng không được bỏ trống!',
            'value.required'            => 'Giá trị điều hướng không được bỏ trống!'
        ];
        $this->validate($request, $rules, $message);
        $paramsStatic = [
            $request->name,
            $request->decription,
            $request->value
        ];

        $air_direction = new AirDirectionService();
        try {
            $response = $air_direction->add($paramsStatic);
        } catch (Exception $e) {
            return response()->json(['status_code' => '500', 'message' => $e->getMessage()]);
        }
        return response()->json(['status_code' => '0', 'data' => $response]);

    }

    public function update(Request $request)
    {
        $rules = [
            'id'                =>'required',
            'name'              =>'required',
            'description'       =>'required',
            'value'             =>'required',
        ];
        $message = [
            'id.required'         => 'ID điều hướng không được bỏ trống!',
            'name.required'         => 'Tên điều hướng không được bỏ trống!',
            'description.required'      => 'Mô tả điều hướng không được bỏ trống!',
            'value.required'     => 'Giá trị điều hướng không được bỏ trống!'
        ];
        $this->validate($request, $rules, $message);
        $this->addToLog($request);
        $paramsStatic = [
            $request->id,
            $request->name,
            $request->description,
            $request->value
        ];

        $air_direction = new AirDirectionService();
        try {
            $response = $air_direction->update($paramsStatic);
        } catch (Exception $e) {
            return response()->json(['status_code' => '500', 'message' => $e->getMessage()]);
        }
        return response()->json(['status_code' => '0', 'data' => $response]);
    }

    public function delete(Request $request) //  author: trinhhuynhdp@gmail.com
    {
        if(request()->ajax()) {
            $request->validate(['id' => 'required']);
            $this->addToLog($request);
            $air_direction = new AirDirectionService();
            $response = $air_direction->delete([$request->id]);
            $res = check_status_code_api($response);
            if(empty($res)) {
                return response()->json($res, 500);
            }
            return response()->json(['data' => $res], 200);
        }
    }

    public function getById(Request $request)
    {
        if(request()->ajax()) {
            $request->validate(['id' => 'required']);
            $this->addToLog($request);
            $air_direction = new AirDirectionService();
            $data = $air_direction->getById([$request->id]);
            $response = check_status_code_api($data);
            if(empty($response)) {
                return redirect()->back()->withErrors('Error! System maintain!');
            }
            return response()->json(get_data_api($response), 200);
        }

    }
}
