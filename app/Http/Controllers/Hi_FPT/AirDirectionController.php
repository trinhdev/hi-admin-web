<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\AirDirectionDataTable;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Services\AirDirectionService;
use Illuminate\Http\Request;
use Matrix\Exception;

class AirDirectionController extends BaseController
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
        $this->addToLog($request);
        $rules = [
            'name'              =>'required',
            'decription'        =>'required',
            'value'             =>'required|url',
            'key'             =>'required',
        ];
        $message = [
            'name.required'             => 'Tên điều hướng không được bỏ trống!',
            'decription.required'       => 'Mô tả điều hướng không được bỏ trống!',
            'value.required'            => 'Giá trị điều hướng không được bỏ trống!',
            'value.url'                 => 'Giá trị điều hướng phải là một đường link url!',
            'key.required'              => 'Khóa điều hướng không được bỏ trống!',
        ];
        $this->validate($request, $rules, $message);
        $paramsStatic = [
            $request->name,
            $request->decription,
            $request->value,
            $request->key
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
        $this->addToLog($request);
        $rules = [
            'id'                =>'required',
            'name'              =>'required',
            'decription'        =>'required',
            'value'             =>'required|url',
            'key'             =>'required',
        ];
        $message = [
            'id.required'           => 'ID điều hướng không được bỏ trống!',
            'name.required'         => 'Tên điều hướng không được bỏ trống!',
            'decription.required'   => 'Mô tả điều hướng không được bỏ trống!',
            'value.required'        => 'Giá trị điều hướng không được bỏ trống!',
            'value.url'             => 'Giá trị điều hướng phải là một đường link url! Ví dụ: https://fpt.workplace.com/',
            'key.required'              => 'Khóa điều hướng không được bỏ trống!',
        ];
        $this->validate($request, $rules, $message);
        $this->addToLog($request);
        $paramsStatic = [
            $request->id,
            $request->name,
            $request->decription,
            $request->value,
            $request->key,
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
        $this->addToLog($request);
        if(request()->ajax()) {
            $request->validate(['id' => 'required', 'key' => 'required']);
            if ($request->key == 'go_to_screen') {
                $res = [
                    'data'=> null,
                    'errors'=> ['Không được xóa điều hướng này']
                ];
                return response()->json($res, 401);
            }
            $this->addToLog($request);
            $air_direction = new AirDirectionService();
            $response = $air_direction->delete([$request->id]);
            return response()->json(['data' => $response], 200);
        }
    }

    public function getById(Request $request)
    {
        $this->addToLog($request);
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
