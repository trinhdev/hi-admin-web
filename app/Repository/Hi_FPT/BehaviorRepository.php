<?php

namespace App\Repository\Hi_FPT;

use App\Models\Behavior;
use App\Http\Traits\DataTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Contract\Hi_FPT\BehaviorInterface;
use App\Models\AppLog;

class BehaviorRepository implements BehaviorInterface
{
    use DataTrait;

    public function index($dataTable, $params)
    {

        try {
            if ($params->has('excel')) {
                $data = $this->store($params);
                return back()->with(['data' => $data ?? [], 'success'=>'Thành công', 'html'=>'Thành công']);
            }
            return view('behavior.index');
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
        $danhsachSDT = [];
        $phone = [];
        foreach($collection as $value) {
            $phone[]=$value['phone'];
            $danhsachSDT[$value['phone']] = $value['date_action'];
        }
        $dataSql = DB::table('app_log')
                    ->select('phone','date_action')
                    ->whereIn('phone', $phone)
                    ->get();


        // echo strtotime('2022-09-19 12:00:29') - strtotime('2022-09-17 01:00:29');
        // $danhsachSDT = [
        //     '0123456789' => '2022-09-17 00:00:00',
        //     '0947182882' => '2022-09-18 06:21:22'
        // ];
        

        $dulieulaytuSQL = [
            0 => ['phone' => '0123456789', 'date_action' => '2022-09-17 01:00:29'],
            1 => ['phone' => '0123456789', 'date_action' => '2022-09-17 13:00:29'],
            2 => ['phone' => '0123456789', 'date_action' => '2022-09-19 23:00:29'],
            3 => ['phone' => '0947182882', 'date_action' => '2022-09-18 15:00:29'],
            4 => ['phone' => '0947182882', 'date_action' => '2022-09-19 18:00:29']
        ];

        // var_dump(123);
        $countDataSQl = $dataSql->count();


        $ketqua = [];

        $total  = [
            '0_2' => [
                'name' => '0-2 ngày',
                '0_'    => 0,
                '1_2'  => 0,
                '3_4'  => 0,
                '5_'   => 0
            ],
            '3_5' => [
                'name' => '3-5 ngày',
                '0_'    => 0,
                '1_2'  => 0,
                '3_4'  => 0,
                '5_'   => 0
            ],
            '6_7' => [
                'name' => '6-7 ngày',
                '0_'    => 0,
                '1_2'  => 0,
                '3_4'  => 0,
                '5_'   => 0
            ]
        ];
        // var_dump($total); die;
        $thongke = [ //value la so luot tuong tac trong khoang thoi gian cua key
            '0_2' => 0, //0-2 ngay
            '3_5' => 0, //3-5 ngay
            '6_7' => 0 //6-7 ngay
        ];

        //Lay so mac dinh dau tien
        $phone = $dataSql[0]->phone;

        //Dem so luong tuong tac cua sdt theo ngay
        for ($i = 0; $i < $countDataSQl; $i++){
            //Neu da count xong sdt hien tai thi count so tiep theo
            if( $dataSql[$i]->phone != $phone){
                //Luu ket qua
                // $ketqua[$phone] = $thongke;

                switch($thongke['0_2']){
                    case  0 : $total['0_2']['0_']   ++; break;
                    case  1 : $total['0_2']['1_2'] ++; break;
                    case  2 : $total['0_2']['1_2'] ++; break;
                    case  3 : $total['0_2']['3_4'] ++; break;
                    case  4 : $total['0_2']['3_4'] ++; break;
                    default : $total['0_2']['5_']  ++; break;
                }

                switch($thongke['3_5']){
                    case  0 : $total['3_5']['0_']   ++; break;
                    case  1 : $total['3_5']['1_2'] ++; break;
                    case  2 : $total['3_5']['1_2'] ++; break;
                    case  3 : $total['3_5']['3_4'] ++; break;
                    case  4 : $total['3_5']['3_4'] ++; break;
                    default : $total['3_5']['5_']  ++; break;
                }

                switch($thongke['6_7']){
                    case  0 : $total['6_7']['0_']   ++; break;
                    case  1 : $total['6_7']['1_2'] ++; break;
                    case  2 : $total['6_7']['1_2'] ++; break;
                    case  3 : $total['6_7']['3_4'] ++; break;
                    case  4 : $total['6_7']['3_4'] ++; break;
                    default : $total['6_7']['5_']  ++; break;
                }

                //Reset bien tam
                $thongke = [
                    '0_2' => 0,
                    '3_5' => 0,
                    '6_7' => 0
                ];
                //Cap nhat so dien thoai can count
                $phone = $dataSql[$i]->phone;
            }

            //Xu ly count so lieu

            $date  = $dataSql[$i]->date_action;
        // var_dump($danhsachSDT[$phone], $phone, $thongke); echo "<br>";
            $day = strtotime($date) -  strtotime($danhsachSDT[$phone]);

            switch(true){
                case ($day <= 172800) :
                    $thongke['0_2'] = $thongke['0_2']+1;
                    break;
                case ($day <= 432000) :
                    $thongke['3_5'] = $thongke['3_5']+1;
                    break;
                case ($day <= 604800) :
                    $thongke['6_7'] = $thongke['6_7']+1;
                    break;
                default :
                    break;
            }
            // var_dump($thongke); echo '<br>';
            // var_dump($total); echo '<br>';
        }

        //Xử lý lượt check cuối cùng từ SQL:
        switch($thongke['0_2']){
            case  0 : $total['0_2']['0_']   ++; break;
            case  1 : $total['0_2']['1_2'] ++; break;
            case  2 : $total['0_2']['1_2'] ++; break;
            case  3 : $total['0_2']['3_4'] ++; break;
            case  4 : $total['0_2']['3_4'] ++; break;
            default : $total['0_2']['5_']  ++; break;
        }

        switch($thongke['3_5']){
            case  0 : $total['3_5']['0_']   ++; break;
            case  1 : $total['3_5']['1_2'] ++; break;
            case  2 : $total['3_5']['1_2'] ++; break;
            case  3 : $total['3_5']['3_4'] ++; break;
            case  4 : $total['3_5']['3_4'] ++; break;
            default : $total['3_5']['5_']  ++; break;
        }

        switch($thongke['6_7']){
            case  0 : $total['6_7']['0_']   ++; break;
            case  1 : $total['6_7']['1_2'] ++; break;
            case  2 : $total['6_7']['1_2'] ++; break;
            case  3 : $total['6_7']['3_4'] ++; break;
            case  4 : $total['6_7']['3_4'] ++; break;
            default : $total['6_7']['5_']  ++; break;
        }

        // $rule = [
        //     'phone' => [
        //         function ($attribute,$value, $fail){
        //             $pattern = '/^(03|05|07|08|09)[0-9, ]*$/';
        //             $pattern_2 = '/^(3|5|7|8|9)[0-9, ]*$/';
        //             if($value == null) {
        //                 return $fail("Số có giá trị trống, thử ctrl+F5 và thử lại");
        //             }
        //             if ((strlen($value)!==10) || (strlen($value)!==9) ) {
        //                 return $fail("Số $value phải sai số lượng (ex: 971380398 or 0971380398)");
        //             }
        //             if(!preg_match($pattern, $value) || !preg_match($pattern_2, $value)) {
        //                 return $fail("Số $value sai định dạng số điện thoại Việt Nam (ex: 0971380398)");
        //             }

        //         }
        //     ],
        // ];
        return $total;
    }
}
