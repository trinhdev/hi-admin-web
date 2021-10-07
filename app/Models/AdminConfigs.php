<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class AdminConfigs extends Model
{
    //
    protected $table = "admin_configs";

    public function getConfigs() {
        $redis = Redis::connection();
        $keyName = 'hi-admin:configs';
        $data = $redis->get($keyName);
        if(!is_null($data)) {
            return unserialize($data);
        }

        $rows = AdminConfigs::where('is_deleted',0)->get();
        foreach ($rows as $row) {
            $data[$row->config_key] = $row;
        }

        $redis->set($keyName, serialize($data));
        return $data;
    }
}
