<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogInvoiceSupplier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];
    protected $table = 'log_invoice_supplier';
}
