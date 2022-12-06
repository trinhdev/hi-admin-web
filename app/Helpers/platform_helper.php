<?php
use Illuminate\Support\HtmlString;
/**
 * File: platformm_helper.php
 * @package Helper
 * Create By phucnh
 * Email: phucnh74@fpt.com.vn
 * Project Eagle Laravel
 * Update: 03-11-2021
 */
if (!function_exists('packages_path')) {

    function packages_path($path = '')
    {
        return __DIR__ . '/../../' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
if (!function_exists('backend_path')) {

    function backend_path($path = '')
    {
        return __DIR__ . '/../' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}


if (!function_exists('vite_assets')) {
    /**
     * @return HtmlString
     * @throws Exception
     */
    function vite_assets($option): HtmlString
    {
        $devServerIsRunning = false;

        if (app()->environment('local')) {
            try {
                $devServerIsRunning = file_get_contents(public_path('hot')) == 'http://127.0.0.1:5173';
            } catch (Exception $e) {}
        }

        if ($devServerIsRunning) {
            $base_url = env('APP_URL', 'localhost');
            return new HtmlString(<<<HTML
            <script type="module" src="{$base_url}:5173/resources/js/app.js"></script>
        HTML);
        }
        $manifest = json_decode(file_get_contents(
            public_path('build/manifest.json')
        ), true);
        if ($option=='css') {
            $data = <<<HTML
                        <link rel="stylesheet" href="/build/{$manifest['resources/js/app.js']['css'][0]}">
                    HTML;
        } else if ($option=='scripts'){
            $data = <<<HTML
                        <script type="module" src="/build/{$manifest['resources/js/app.js']['file']}"></script>
                    HTML;
        }
        return new HtmlString($data);
    }
}


if (!function_exists('get_data_api')) {
    function get_data_api( $response ) {
        if (isset($response->statusCode) && $response->statusCode == 0 && !empty($response->data)) {
            return $response->data;
        }
    }
}

if (!function_exists('check_status_code_api')) {
    function check_status_code_api( $response ) {
        if (isset($response->statusCode) && $response->statusCode == 0) {
            return $response;
        }
    }
}

if (!function_exists('get_error_message_api')) {
    function get_error_message_api( $response ) {
        if (isset($response->statusCode) && $response->statusCode != 0) {
            return $response->message;
        }
    }
}

if (!function_exists('write_log_file')) {
    function write_log_file($filename = 'error', $message = NULL, $level = 'error')
    {
        if (is_array($message))
            $message = json_encode($message);
        $message = date('d/m/Y H:i:s') . ":\t$message\n";
        $logFile = $filename . '.log';
        $log_path = storage_path() . '/logs/' . $logFile;
        write_file($log_path, $message, 'a');
        /*
        $logFile = $filename.'.log';
        \Log::useFiles(storage_path() . '/logs/' . $logFile);
        if($level == 'error') Log::error($message);
        else if($level == 'info') Log::info($message);
        else if($level == 'emergency') Log::emergency($message);
        else if($level == 'critical') Log::critical($message);
        else if($level == 'warning') Log::warning($message);
        else if($level == 'notice') Log::notice($message);
        else if($level == 'debug') Log::debug($message);*/
    }
}
if (!function_exists('write_file')) {
    /**
     * Write File
     *
     * Writes data to the file specified in the path.
     * Creates a new file if non-existent.
     *
     * @param    string $path File path
     * @param    string $data Data to write
     * @param    string $mode fopen() mode (modules: 'wb')
     * @return    bool
     */
    function write_file($path, $data, $mode = 'wb')
    {
        if (!$fp = @fopen($path, $mode)) {
            return FALSE;
        }

        flock($fp, LOCK_EX);

        for ($result = $written = 0, $length = strlen($data); $written < $length; $written += $result) {
            if (($result = fwrite($fp, substr($data, $written))) === FALSE) {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return is_int($result);
    }
}
if (!function_exists('my_debug')) {

    function my_debug($var, $is_die = true)
    {
        echo '<pre>' . print_r($var, true) . '</pre>';
        if ($is_die) {
            die();
        }
    }
}
if (!function_exists('generate_uuid')) {
    function generate_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
if (!function_exists('mb_ucwords')) {
    function mb_ucwords($str)
    {
        return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    }
}

if (!function_exists('sendRequest')) {
    function sendRequest($url, $params, $token = null, $headerArray = array(),$method = null)
    {
        $headers[] = "Content-Type: application/json";
        $headers[] = (!empty($token)) ? "Authorization: " . $token : null;
        if(!empty($headerArray)){
            foreach($headerArray as $key => $val){
                $headers[] = $key.": ". $val;
            }
        }
        //dd($headers);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout in seconds

        // if(env('APP_ENV') !== 'local'){
        //     curl_setopt($ch, CURLOPT_PROXY, 'proxy.hcm.fpt.vn:80');
        //     curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
        // }

        $time = microtime(true);
        if(!empty($method)){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }
        $output = curl_exec($ch);
        // dd($output);
        $timeRun = microtime(true) - $time;
        if (curl_errno($ch)) {
            // dd("lỗi .".curl_error($ch));
            // my_debug($url.'</br>'.curl_error($ch));
        }
        curl_close($ch);
        // my_debug($output.'</br>'.$url);
        return json_decode($output);
    }
}

if (!function_exists('convert_vi_to_en')) {
    function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
}

if (!function_exists('printJson')) {
    function printJson($data, $statusObject = null, $lang = null){
       if($statusObject == null){
           $statusObject = buildStatusObject('HTTP_OK');
       };
       $response = [];
       $response['statusCode'] = $statusObject->code;
       $response['message'] = ($lang == 'en') ? $statusObject->message_en : $statusObject->message;
       $response['data'] = $data;
       return response()->json($response);
   }
}

if (!function_exists('buildStatusObject')) {
    function buildStatusObject($status){
        $statusCodeObject = app('statusCodeObject')->getObject($status);
        return $statusCodeObject;
    }
}
if (!function_exists('isJson')) {
    function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}

if (!function_exists('rand_color')) {
    function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}

if (!function_exists('changeFormatDateLocal')) {
    function changeFormatDateLocal($value) {
        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}


