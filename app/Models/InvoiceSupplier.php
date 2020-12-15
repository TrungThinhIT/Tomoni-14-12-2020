<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSupplier extends Model
{
    use HasFactory;

    protected $table = 'acountant_hddv';

    public function detail(){
        return $this->hasMany(InvoiceDetailSupllier::class, 'Invoice' , 'Invoice');
    }
}
