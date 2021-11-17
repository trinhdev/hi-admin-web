<?php
namespace App\Http\Controllers;

class HelperController {
    
    function md5Convert($input) {
        return md5($input);
    }
}