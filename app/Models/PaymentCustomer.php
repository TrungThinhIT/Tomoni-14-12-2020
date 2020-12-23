<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCustomer extends Model
{
    use HasFactory;

    protected $table = 'quanlythe';
    public $timestamps = false;

    protected $guarded = [];
}
