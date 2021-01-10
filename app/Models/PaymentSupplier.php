<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSupplier extends Model
{
    use HasFactory;
    protected $table = 'payment_supplier';
    public $timestamps = false;
    protected $primaryKey = "Id";
    protected $guarded = [];
}
