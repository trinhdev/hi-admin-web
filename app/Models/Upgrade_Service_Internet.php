<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class Upgrade_Service_Internet extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'upgrade_service_internet';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'trans_id','customer_id','customer_phone','contract_no','ObjID','request_date','effective_date','service_old_id','service_new_id','service_price','service_fee','debt','total_amount_finish','t_create','ticket_id','link_id','receipt_id','bill_number','is_upgraded','is_paid','is_ptc_pth','is_ocr','new_promotion','payment_status', 'receipt_type', 'payment_date', 'h_t_create', 'service_name_old', 'service_name_new', 'created_at', 'updated_at'];
    
    public function contract() {
        return $this->hasOne(Contracts::class, 'contract_no', 'contract_no');
    }
}
