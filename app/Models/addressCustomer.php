<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addressCustomer extends Model
{
    use HasFactory;
    protected $table = 'address_customer';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
