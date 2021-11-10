<?php
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
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
if (!function_exists('mb_ucwords'))
{
	function mb_ucwords($str)
	{
		return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
	}
}