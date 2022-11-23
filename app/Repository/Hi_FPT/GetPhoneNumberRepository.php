<?php

namespace App\Repository\Hi_FPT;

use App\Models\GetPhoneNumber;
use App\Http\Traits\DataTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Contract\Hi_FPT\GetPhoneNumberInterface;
use App\Models\AppLog;

class GetPhoneNumberRepository implements GetPhoneNumberInterface
{
    use DataTrait;

    public function index($params)
    {
        try {
            if ($params->has('excel')) {
                $data = $this->store($params);
                return back()->with(['data' => $data ?? [], 'success'=>'Thành công', 'html'=>'Thành công']);
            }
            return view('get-phone-number.index');
        } catch (\Exception $e) {
            return back()->with(['error'=>'Lỗi hệ thống', 'html'=>$e->getMessage()]);
        }
    }

    public function store($params)
    {

        $filePath = $params->file('excel')->path();
        $newFilePath =  $filePath . '.' . $params->file('excel')->getClientOriginalExtension();
        move_uploaded_file($filePath, $newFilePath);
        $collection = (new FastExcel)->import($newFilePath);
        $list_customer_id = [];
        foreach($collection as $value) {
            if (!empty($value['customer_id'])) {
                $list_customer_id[]=$value['customer_id'];
            }
        }
         // Retrieve errors message bag
        return DB::connection('mysql4')->table('customers')
                    ->select('customer_id','phone')
                    ->whereIn('customer_id', $list_customer_id)
                    ->get()->toArray();
    }
}
