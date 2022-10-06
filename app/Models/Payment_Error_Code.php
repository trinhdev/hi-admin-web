<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Error_Code extends Model
{
    public $timestamps = true;
    protected $table = 'payment_error_code';
    protected $primaryKey = 'id';
    protected $fillable = ['code_error', 'description_error', 'color', 'is_send_mail', 'is_system'];
}
