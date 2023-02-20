<?php

namespace App\Models;

use App\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Awobaz\Compoships\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class Customers extends Model
{
    use Cacheable;

    protected $cacheTime = 5;
    protected $connection = 'mysql4';
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    public $timestamps = false;
    protected $fillable = ['customer_id', 'phone', 'password', 'salt', 'provider', 'provider_id', 'last_login_protocol', 'last_authen_mechanism', 'is_active_phone', 'loyalty_status', 'foxpay_status', 'keep_me_logged_in', 'is_customer_fpt', 'ftel_customer_id', 'session_token_encode', 'device_id', 'device_name', 'device_token', 'device_platform', 'device_token_bad', 'install_from', 'fullname', 'email', 'birthday', 'address', 'gender', 'avatar', 'expired_time_lock', 'date_login', 'date_created', 'date_modified', 'customer_location_id', 'unread_notify', 'notification_gateway_id', 'app_version', 'app_language', 'move', 'device_info', 'configs', 'notification_id_updated_at', 'is_deleted'];

    // public function contracts() {
    //     return $this->hasMany(Contracts::class, 'customer_id', 'customer_id');
    // }

    public function customer_contract() {
        return $this->hasMany(Customer_Contract::class, 'customer_id', 'customer_id');
    }

    public function count_no_contract($from1, $to1, $from2, $to2) {
        return DB::connection('mysql4')->select("
            SELECT SUM(IF(DATE(customers.date_created) BETWEEN '$from1' AND '$to1', 1, 0)) AS 'count_last_month', SUM(IF(DATE(customers.date_created) BETWEEN '$from2' AND '$to2', 1, 0)) AS 'count_this_month'
            FROM customers
            LEFT JOIN customer_contract
                ON customers.customer_id = customer_contract.customer_id
            WHERE customer_contract.contract_id IS NULL AND customers.date_created BETWEEN '$from1' AND '$to2'
        ");
    }
}
