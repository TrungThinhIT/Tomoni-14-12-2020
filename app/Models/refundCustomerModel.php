<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refundCustomerModel extends Model
{
    use HasFactory;
    protected $table = 'refund_customer';
    protected $primaryKey = 'id';
    protected $guarded =[];
    public $timestamps = false;
}
