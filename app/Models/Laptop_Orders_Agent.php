<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop_Orders_Agent extends MY_Model
{
    protected $table = 'view_agent_tb';
    protected $primaryKey = 'id';
    protected $fillable = ['agent_id','merchant_id','service_type','agent_name','src_img','list_payment_method','payment_methods','description_error','invalid_locations'];
}
