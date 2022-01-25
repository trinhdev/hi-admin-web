<?php

namespace App\Http\Controllers\Hi_FPT;

use App\Http\Controllers\MY_Controller;
use Illuminate\Http\Request;

use App\Http\Traits\DataTrait;
use \stdClass;

use Yajra\DataTables\DataTables;

use App\Models\Settings;

use App\Services\IconManagementService;

class IconcategoryController extends MY_Controller
{
    use DataTrait;
    protected $module_name = 'Icon_Category';
    protected $model_name = "Icon_Category";
    protected $iconManagement = null;
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Icon Category';
        $this->iconManagement = new IconManagementService();
        // $this->model = $this->getModel('Icon_Management');
    }

    public function index()
    {
        //get view list
        $data = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $data['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        return view('icon_category.list')->with($data);
    }

    public function edit() {
        // get view edit
        // $data = parent::edit1();
        $data = [
            'controller'    => 'iconcategory'
        ];
        $id = request()->segment(3);
        if(!empty($id)) {
            $data['id'] = $id;
            $response = json_decode(json_encode($this->iconManagement->getProductTitleById($id)), true);
            if(!empty($response['data'])) {
                $response['data']['productListId'] = (isset($response['data']['arrayId']) && is_string($response['data']['arrayId'])) ? explode(',', $response['data']['arrayId']) : [];
                $productList = json_decode(json_encode($this->iconManagement->getAllProduct()), true);
                $response['data']['productList'] = (!empty($productList['data'])) ? $productList['data'] : [];
                $response['data']['productListInTitle'] = [];
                foreach($response['data']['productListId'] as $productId) {
                    foreach($response['data']['productList'] as $product) {
                        if(intval($productId) == $product['productId']) {
                            array_push($response['data']['productListInTitle'], $product);
                        }
                    }
                }
                
                $data['data'] = $response['data'];
            }
        }
        
        $loai_dieu_huong = Settings::where('name', 'icon_loai_dieu_huong')->get();
        $data['loai_dieu_huong'] = (!empty($loai_dieu_huong[0]['value'])) ? json_decode($loai_dieu_huong[0]['value'], true) : [];
        return view('icon_category.edit')->with($data);
    }

    public function save(Request $request) {
        // $id = request()->segment(3);
        // if(!empty($id)) {

        // }
        // dd($request);
        $result = $this->list1();
        $icon_approve = Settings::where('name', 'icon_approve')->get();
        $result['icon_approve'] = (!empty($icon_approve[0]['value'])) ? json_decode($icon_approve[0]['value'], true) : [];
        $request->session()->flash('success', 'success');
        $request->session()->flash('html', 'Đã gửi yêu cầu đến bộ phận kiểm duyệt. Vui lòng chờ kiểm tra và phê duyệt trước khi hoàn tất yêu cầu.');
        return redirect()->route('iconcategory.index')->with($result);
    }

    public function detail($productTitleId) {
        $data['productTitleId'] = $productTitleId;
        $response = json_decode(json_encode($this->iconManagement->getProductTitleById($productTitleId)), true);
        
        if(!empty($response['data'])) {
            $response['data']['productListId'] = (isset($response['data']['arrayId']) && is_string($response['data']['arrayId'])) ? explode(',', $response['data']['arrayId']) : [];
            $productList = json_decode(json_encode($this->iconManagement->getAllProduct()), true);
            $response['data']['productList'] = (!empty($productList['data'])) ? $productList['data'] : [];
            $response['data']['productListInTitle'] = [];
            foreach($response['data']['productListId'] as $productId) {
                foreach($response['data']['productList'] as $product) {
                    if(intval($productId) == $product['productId']) {
                        array_push($response['data']['productListInTitle'], $product);
                    }
                }
            }
            
            $data['data'] = $response['data'];
        }
        $detail_prod_title = view('icon_category.detail')->with($data);
        return $detail_prod_title->render();
    }

    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
        }
        $request->file->move(public_path('images/upload'), $imageName);
        return ['success' => 'You have successfully upload image.', 'url' => $imageName];
    }

    public function initDatatable(Request $request){
        if($request->ajax()){
            $response = json_decode(json_encode($this->iconManagement->getAllProductTitle()), true);
            $data = [];
            if(!empty($response['data'])) {
                $data = $response['data'];
            }
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
        }
    }
}
