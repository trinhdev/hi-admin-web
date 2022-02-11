<?php

namespace App\Imports;

use App\Models\FtelPhone;
use App\Services\HrService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class FtelPhoneImport implements ToModel, WithBatchInserts, WithValidation, SkipsEmptyRows
{
    use Importable; 

    public function model(array $row)
    {
        $hrService = new HrService();
        $token = $hrService->loginHr()->authorization;
        $findPhone = FtelPhone::where('number_phone',$row[0])->first();
        if(isset($findPhone) && now()->subWeeks() >= $findPhone->updated_at) {
            $getInfo = $hrService->getInfoEmployee($phone,$token);
            if(isset($getInfo)) {
                $findPhone->update([
                    'number_phone' => $row[0],
                    'code' => $getInfo->code,
                    'emailAddress' => $getInfo->emailAddress,
                    'fullName' => $getInfo->fullName,
                    'response' => json_encode($getInfo),
                    'organizationNamePath' => $getInfo->organizationNamePath, 
                    'organizationCodePath' => $getInfo->organizationCodePath
                ]);
            } else {
                $findPhone->update([
                    'updated_at' => now()
                ]);
            }
        } elseif(isset($findPhone)) {
            $getInfo = $hrService->getInfoEmployee($row[0],$token);
            if(isset($getInfo)) {
                $obj = [
                    'number_phone'=> $row[0],
                    'code' => $getInfo->code,
                    'emailAddress' => $getInfo->emailAddress,
                    'fullName'=> $getInfo->fullName,
                    'response' => json_encode($getInfo),
                    'organizationNamePath' => $getInfo->organizationNamePath, 
                    'organizationCodePath' => $getInfo->organizationCodePath
                ];
                $findPhone->update($obj);

            } else {
                $findPhone->update([
                    'updated_at' => now()
                ]);
            }
        } elseif(empty($findPhone)) {
            $getInfo = $hrService->getInfoEmployee($row[0],$token);
            if(empty($getInfo)) {
                FtelPhone::create([
                    'number_phone'=> $row[0],
                    'created_by' => Auth::id(),
                ]);
            } else {                                  
                $obj = [
                    'number_phone'=> $row[0],
                    'code' => $getInfo->code,
                    'emailAddress' => $getInfo->emailAddress,
                    'fullName'=> $getInfo->fullName,
                    'response' => json_encode($getInfo),
                    'organizationNamePath' => $getInfo->organizationNamePath, 
                    'organizationCodePath' => $getInfo->organizationCodePath
                ];
                $code = FtelPhone::where('code',$getInfo->code)->first();
                if(isset($code)) {
                    $code->update($obj);
                } else {
                    $obj['created_by'] = Auth::id();
                    FtelPhone::create($obj);
                }               
            }
            }
        // return new FtelPhone([
        //     'number_phone'  => $row[0],
        // ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            '0' => [
                function ($attribute,$value, $fail){
                    $pattern = '/^(03|05|07|08|09)[0-9, ]*$/';
                    if ((strlen($value)!==10)) {
                        return $fail("Trường $value phải đúng 10 kí tự");
                    }                            
                    if(!preg_match($pattern, $value)) {
                        return $fail("Trường $value sai định dạng số điện thoại Việt Nam");
                    }
                }
            ]
        ];
    }

}
