<?php 
namespace App\Providers; 

use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem; 

class MinIOServiceProvider extends ServiceProvider{ 
    /** * Register services. * * 
     * @return void */ 
    
     public function register() { 
        /** * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter */ 
        Storage::extend('minio', function ($app, $config) { 
            $client = new S3Client([ 
                'credentials' => [ 'key' => $config['key'], 
                'secret' => $config['secret'], ], 
                'region' => $config['region'], 
                'version' => 'latest', 
                'bucket_endpoint' => false, 
                'use_path_style_endpoint' => true, 
                'endpoint' => $config['endpoint'], 
            ]); 
            $root = $config['root'] ?? null; $options = $config['options'] ?? []; 
            return new Filesystem(new AwsS3Adapter($client, $config['bucket'], $root, $options)); }); 
        } 
        
        /** * Bootstrap services. * * @return void */ 
        public function boot() {}
}
