<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Cronlogtest;
class Minio
{
    public static function uploadMinio($url, $content) {
        // link: hifpt/report/hdi/test1.txt
        try {
            $result = Storage::disk('minio')->put($url, $content);
            return $result;
        }
        catch(Exception $e) {
            Cronlogtest::create([
                'cron_name' => 'check create folder',
                'value'     => 'uploadMinio',
                'note'      => $e->getMessage(),
            ]);
            return false;
        }
    }

    public static function deleteFolderMinio($url) {
        try {
            Storage::disk('minio')->deleteDirectory($url);
        }
        catch(Exception $e) {
            Cronlogtest::create([
                'cron_name' => 'check delete folder',
                'value'     => 'deleteFolderMinio',
                'note'      => $e->getMessage(),
            ]);
            return false;
        }
    }

    public static function createFolderMinio($url) {
        try {
            Storage::disk('minio')->makeDirectory($url);
        }
        catch(Exception $e) {
            Cronlogtest::create([
                'cron_name' => 'check delete folder',
                'value'     => 'deleteFolderMinio',
                'note'      => $e->getMessage(),
            ]);
            return false;
        }
    }
}
