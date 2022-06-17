<?php

namespace App\Http\Controllers;


use App\Services\NewsEventService;
use Illuminate\Http\Request;
use stdClass;

class FileController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

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
}
