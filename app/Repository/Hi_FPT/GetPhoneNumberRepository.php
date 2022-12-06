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

    public function index()
    {
        return view('get-phone-number.index');
    }

    public function store($params)
    {
        $from = changeFormatDateLocal($params->input('show_from'));
        $to = changeFormatDateLocal($params->input('show_to'));
        if(!empty($params->input('show_to')) && !empty($params->input('show_from'))) {
            $data = DB::connection('mysql4')->table('customers')
                ->select('customer_id','phone')
                ->whereBetween('date_created', [$from,$to])
                ->get();
        } else {
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
            $data = DB::connection('mysql4')->table('customers')
                ->select('customer_id','phone')
                ->whereIn('customer_id', $list_customer_id)
                ->get();
        }
        return back()->with(['data' => $data ?? [], 'success'=>'Thành công', 'html'=>'Thành công']);
    }
}
