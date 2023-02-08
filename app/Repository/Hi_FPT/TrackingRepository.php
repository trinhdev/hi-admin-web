<?php

namespace App\Repository\Hi_FPT;

use App\Contract\Hi_FPT\TrackingInterface;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Models\Employees;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TrackingRepository implements TrackingInterface
{
    use DataTrait;

    public function index()
    {
        return view('tracking.index');
    }

    public function show($id)
    {
        $data = DB::table('Trackings')->find($id);
        return view('Tracking.edit', ['data'=>$data]);
    }

    public function create()
    {
        return view('Tracking.create');
    }

    public function store($params)
    {
        try {
            DB::table('Trackings')->insert($params->only(['direction','name','url']));
            switch ($params->input('action')) {
                case 'back':
                    return redirect()->intended('Tracking')->with(['success'=>'Update thành công', 'html'=>'Thêm mới thành công']);;
                case 'stay':
                    return redirect()->back();
            }
        } catch (\Exception $e) {
            return back()->with(['error'=>'Lỗi hệ thống', 'html'=>$e->getMessage()]);
        }
    }

    public function update($params, $id)
    {
        Tracking::find($id)->update($params->only(['direction','name','url']));
        switch ($params->input('action')) {
            case 'back':
                return redirect()->intended('Tracking')->with(['success'=>'Update thành công', 'html'=>'Update thành công']);
            case 'stay':
                return redirect()->back()->with(['success'=>'Update thành công', 'html'=>'Update thành công']);
        }
    }

    public function delete($id)
    {
        Tracking::destroy($id);
        return redirect()->intended('Tracking')->with(['success'=>'Delete thành công', 'html'=>'Delete thành công']);
    }

}
