<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'accoutant_order';
    public $timestamps = false;
    protected $primaryKey = "Id";

    protected $fillable = ['Id', 'So_Hoadon', 'PriceIn', 'PriceOut', 'Codeorder', 'note', 'Date_Create', 'delete_at'];

    public function Order(){
        return $this->belongsTo(Order::class, 'Codeorder', 'codeorder');
    }

    public function Product(){
        return $this->belongsTo(Product::class, 'Codeorder', 'codeorder');
    }
}
