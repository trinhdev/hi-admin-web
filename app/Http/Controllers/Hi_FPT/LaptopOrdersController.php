<?php

namespace App\Http\Controllers\Hi_FPT;

use App\DataTables\Hi_FPT\LaptopOrdersDatatables;
use App\Http\Controllers\MY_Controller;
use App\Http\Traits\DataTrait;
use App\Models\Laptop_Orders;
use Illuminate\Http\Request;

class LaptopOrdersController extends MY_Controller
{
    use DataTrait;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Laptop Order Manager';
    }
    public function index(LaptopOrdersDatatables $dataTable) {
        return $dataTable->render('laptop-order.index');
    }
    public function edit(Request $request, $id) {
        $data = Laptop_Orders::where('trans_id', $id)->first();
        return view('laptop-order.edit', compact('data'));
    }
    public function update(Request $request, $id) {
        Laptop_Orders::where('trans_id', $id)->first()->update($request->only(['referral_code']));
        switch ($request->input('action')) {
            case 'back':
                return redirect()->intended('laptop-orders')->with(['success'=>'Update thành công', 'html'=>'Update thành công']);
            case 'stay':
                return redirect()->back()->with(['success'=>'Update thành công', 'html'=>'Update thành công']);
        }
    }
}
