<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saleplatform_Shopping_Orders extends Model
{
    public $timestamps = true;
    protected $table = 'view_saleplatform_shopping_orders';
    // protected $table = 'payment_orders';
    protected $primaryKey = 'order_id';
    protected $fillable = ['order_id', 'customer_id', 'customer_phone', 'saleteam_id', 'service_key', 'sub_type', 'inside_order_id', 'inside_order_code', 'inside_order_status', 'inside_order_create_time', 'buyer_full_name', 'buyer_phone', 'buyer_email', 'buyer_birth_date', 'buyer_passport', 'buyer_gender', 'subtotal_cost', 'discount_amount', 'total_cost', 'payment_method', 'payment_status', 'order_status', 'is_debt', 'payment_order_id', 'payment_merchant_id', 'note', 'deploy_appointment_date', 'deploy_appointment_time', 'referral_phone', 'contract_id', 'contract_no', 'econtract_code', 'econtract_id', 'location_zone', 'completed_register_date', 'ordered_success_date', 'date_created', 'date_last_updated', 'next_tracking_time'];
}
