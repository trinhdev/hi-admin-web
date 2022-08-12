<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class Vietlott_Orders extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vietlott_orders';
    protected $primaryKey = 'id';
    protected $fillable = ['trans_id','order_code','merchant_code','customer_id','order_time','order_status','payment_status','payment_method','customer_name','phone','base_price','price','product_name','quantity','product_price','category','discount','discount_price','t_create','t_update'];
    
}
