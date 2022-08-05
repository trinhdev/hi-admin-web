<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Orders extends Model
{
    public $timestamps = true;
    protected $table = 'view_payment_orders';
    // protected $table = 'payment_orders';
    protected $primaryKey = 'order_id';
    protected $fillable = ['order_id', 'customer_id', 'customer_phone', 'amount', 'order_status', 'payment_type', 'payment_method', 'payment_provider', 'payment_provider_status', 'payment_provider_date_success', 'payment_provider_transaction_id', 'payment_bank_code', 'tokenization_id', 'is_tokenization', 'voucher', 'vouchers', 'merchant_id', 'language', 'title', 'description', 'gateway_description', 'currency', 'date_created', 'date_modified', 'ipn_pending', 'ipn_count', 'ipn_date_paid', 'day_failed', 'payurl_redirect', 'autopay_contract', 'is_link_tokenization', 'version'];
}
