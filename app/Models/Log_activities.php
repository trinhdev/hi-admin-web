<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_activities extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'param', 'url', 'method', 'ip', 'agent', 'user_id'
    ];

    // protected $casts = [
    //     'param' => 'array',
    // ];
}