<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
class Minio
{
    public function uploadMinio($url, $content) {
        // link: hifpt/report/hdi/test1.txt
        try {
            $result = Storage::disk('minio')->put($url, $content);
            return $result;
        }
        catch(Exception $e) {
            return $e->getMessage();
        }
    }
}