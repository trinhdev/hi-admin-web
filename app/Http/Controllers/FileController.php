<?php

namespace App\Http\Controllers;


use App\Services\NewsEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use stdClass;

class FileController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadImageExternal(Request $request){
        $request->validate([
            'file'  =>'required'
        ]);
        $file = $request->file('file');
        $param = [
            'imageFileName'=>  $file->getClientOriginalName(),
            'encodedImage' =>   base64_encode(file_get_contents($file))
        ];
        $newsEventService = new NewsEventService();
        return response()->json($newsEventService->uploadImage($param['imageFileName'], $param['encodedImage']));
    }

    public function importPhone(Request $request)
    {
        $request->validate(['excel.*' => 'mimes:xlsx'],['excel.*.mimes' => 'Sai định dạng file, chỉ chấp nhận file có đuôi .xlsx']);
        $data = [];
        foreach ($request->file('excel') as $key => $item){
            $data['data'][] = fastexcel()->import($item)->flatten();
            if (count($data['data'][$key]) > LIMIT_PHONE) {
                return response()->json(['errors' => ['error'=>'Data in files '.($key+1).' too big <= '.LIMIT_PHONE.'K']], 401);
            }
        }
        return $data;
    }
}
