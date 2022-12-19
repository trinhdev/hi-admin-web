<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentUnpaid extends Model
{
    use HasFactory;
    protected $table = 'payment_unpaid';
    protected $primaryKey = 'id';
}
