<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPaymentSupplier extends Model
{
    use HasFactory;
    protected $table = 'log_payment_supplier';
    public $timestamps = false;
    protected $primaryKey = "Id";
    protected $guarded = [];
}
