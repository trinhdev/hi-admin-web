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
            // 'imageFileName' => 'required',
            // 'encodedImage' =>'required'
            'file'  =>'required'
        ]);
        $file = $request->file('file');
        $param = [
            'imageFileName'=>  $file->getClientOriginalName(),
            'encodedImage' =>   base64_encode(file_get_contents($file))
        ];
        $newsEventService = new NewsEventService();
        $uploadImage_response = $newsEventService->uploadImage($param['imageFileName'], $param['encodedImage']);
        $obj = new stdClass();
        $image = new stdClass();
        $image->uploadedImageUrl = $uploadImage_response->data->uploadedImageUrl;
        $image->uploadedImageFileName = $uploadImage_response->data->uploadedImageFileName;
        $obj->statusCode = 0;
        $obj->message = "Thành công";
        $obj->data = $image;
        return $obj;
    }
}
