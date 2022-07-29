<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Awobaz\Compoships\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class Laptop_Orders extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'laptop_orders';
    protected $primaryKey = 'trans_id';
    protected $fillable = ['trans_id','merchant_id','order_id','customer_id','customer_phone','address_id','fullname','phone_nb','address','city','district','ward','lat_long','amount','promotion_code','referral_code','amount_voucher','total_amount_finish','appointment_date','timezone','note','payment_method','isTokenization','tokenizationId', 'order_id_payment', 'payment_status', 't_create', 'histories_order_id_payment', 'id_fsh', 'email', 'order_state', 'description_state', 'rule_next_step', 'color_code', 'status_ship60', 'list_item', 'list_tracking', 'full_address', 't_create_str', 't_deliver', 'agent_id', 'txt_list_item'];

    public function employees() {
        return $this->hasOne(Employees::class, 'phone', 'referral_code');
    }

    public function memberswithhifpt() {
        return $this->hasOne(Members_With_HiFPT::class, 'phone', 'referral_code');
    }
    
    public function countReportData($branch, $from, $to) {
        return DB::connection('mysql')->select("
            SELECT COUNT(`trans_id`) AS count, SUM(`total_amount_finish`) AS amount
            FROM `laptop_orders`
            WHERE `order_state` = 'ORDER_DELIVERED' AND `referral_code` IN
            (
                SELECT `phone`
                FROM `employees`
                WHERE `phone` != '' AND `phone` IS NOT NULL AND location_id IN ($branch)
            ) AND `t_create` BETWEEN '$from' AND '$to';
        ");
    }

    public function getDetailReportData($branch, $from, $to) {
        return DB::connection('mysql')->select("
            SELECT laptop_orders.phone_nb, laptop_orders.fullname, laptop_orders.payment_status, laptop_orders.order_state, laptop_orders.amount, laptop_orders.t_create, laptop_orders.referral_code, employees.name, employees.full_name, ftel_branch.branch_name
            FROM `laptop_orders`
            LEFT OUTER JOIN employees
            ON employees.phone = laptop_orders.referral_code
            LEFT OUTER JOIN ftel_branch
            ON employees.location_id=ftel_branch.location_id AND employees.branch_code=ftel_branch.branch_code
            WHERE `order_state` = 'ORDER_DELIVERED' AND `referral_code` IN
            (
                SELECT `phone`
                FROM `employees`
                WHERE `phone` != '' AND `phone` IS NOT NULL AND location_id IN ($branch)
            ) AND `t_create` BETWEEN '$from' AND '$to';
        ");
    }

    public function countReportDataPNCTIN($type, $zone, $from, $to) {
        return DB::connection('mysql')->select("
            SELECT COUNT(`trans_id`) AS count, SUM(`total_amount_finish`) AS amount
            FROM `laptop_orders`
            LEFT OUTER JOIN employees
            ON Replace(coalesce(employees.phone,''), ' ','') = laptop_orders.referral_code
            LEFT OUTER JOIN ftel_branch
            ON employees.location_id=ftel_branch.location_id AND employees.branch_code=ftel_branch.branch_code
            LEFT OUTER JOIN customer_locations
            ON employees.location_id=customer_locations.customer_location_id
            WHERE `order_state` = 'ORDER_DELIVERED' AND `referral_code` IN
            (
                SELECT Replace(coalesce(`phone`,''), ' ','') as `phone`
                FROM `employees`
                WHERE `name` LIKE '$type' AND `phone` != '' AND `phone` != '0' AND `phone` IS NOT NULL AND location_zone IN ('$zone')
            ) AND laptop_orders.t_create BETWEEN '$from' AND '$to';
        ");
    }

    public function getDetailReportDataPNCTIN($type, $zone, $from, $to) {
        return DB::connection('mysql')->select("
            SELECT customer_locations.location_name, laptop_orders.order_id, laptop_orders.customer_phone, laptop_orders.fullname, laptop_orders.payment_method, laptop_orders.order_state, laptop_orders.total_amount_finish, laptop_orders.t_create, laptop_orders.referral_code, employees.name, employees.full_name, ftel_branch.branch_name
            FROM `laptop_orders`
            LEFT OUTER JOIN employees
            ON Replace(coalesce(employees.phone,''), ' ','') = laptop_orders.referral_code
            LEFT OUTER JOIN ftel_branch
            ON employees.location_id=ftel_branch.location_id AND employees.branch_code=ftel_branch.branch_code
            LEFT OUTER JOIN customer_locations
            ON employees.location_id=customer_locations.customer_location_id
            WHERE `order_state` = 'ORDER_DELIVERED' AND `referral_code` IN
            (
                SELECT Replace(coalesce(`phone`,''), ' ','') as `phone`
                FROM `employees`
                WHERE `name` LIKE '$type' AND `phone` != '' AND `phone` != '0' AND `phone` IS NOT NULL AND location_zone IN ('$zone')
            ) AND laptop_orders.t_create BETWEEN '$from' AND '$to';
        ");
    }
}
