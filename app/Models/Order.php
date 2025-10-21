<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        "total",
        "customername",
        "customerlastname",
        'customerprovince',
        'customermunicipality',
        'customerstreet',
        'customerphone',
        'customerotherphone',
        'customerpaymenttype',
        'receipt',
        'finddetail',
        'customerotheraddress',
    ];
}
