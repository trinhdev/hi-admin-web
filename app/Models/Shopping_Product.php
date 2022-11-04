<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping_Product extends Model
{
    public $timestamps = true;
    protected $table = 'view_shopping_product_tb';
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_id', 'product_priority', 'merchant_id', 'agent_id', 'category_id', 'sku', 'product_src_img', 'product_supplier_name', 'product_name', 'product_option', 'icon_option', 'secification', 'product_desciption', 't_warranty', 'usual_price', 'discount_price', 'unit_type', 'product_active', 't_create', 'available_area', 'description', 'description_img', 'slide_img', 'service_type', 'use_fgold', 'use_installment', 'program_flash_sales', 'deposit', 'ship_fee', 'frame_id'];
}
