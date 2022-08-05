<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Products extends Model
{
    public $timestamps = true;
    protected $table = 'payment_product';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'code', 'name', 'type'];
}
