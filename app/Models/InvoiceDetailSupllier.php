<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetailSupllier extends Model
{
    use HasFactory;

    protected $table = 'acountant_jancodeitem';

    public function product(){
        return $this->hasOne(ProductStandard::class, 'jan_code', 'Jancode');
    }
}
