<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetailSupplier extends Model
{
    use HasFactory;

    protected $table = 'acountant_jancodeitem';
    public $timestamps = false;

    protected $guarded = [];
    public function product()
    {
        return $this->hasOne(ProductStandard::class, 'jan_code', 'Jancode');
    }
}
