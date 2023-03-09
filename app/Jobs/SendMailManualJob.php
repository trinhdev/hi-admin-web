<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class SendMailManualJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $key;
    protected $time;

    public function __construct($key, $time)
    {
        $this->key = $key;
        $this->time = $time;
    }

    public function handle()
    {
        $originalDataTime = setting('hi_admin_cron_'.$this->key.'_time');
        Cache::put($this->key, $originalDataTime, 0.2);
        setting()->set('manually_email_'.$this->key.'_time', $this->time);
        setting()->set('hi_admin_cron_'.$this->key.'_time', '*/1 * * * *');
        setting()->save();
        sleep(10);

        $originalData = Cache::get($this->key) ?? '0 6 * * 3';
        setting()->set('manually_email_'.$this->key.'_time', '');
        setting()->set('hi_admin_cron_'.$this->key.'_time', $originalData);
        setting()->save();
    }
}
