<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returnProductModel extends Model
{
    use HasFactory;
    protected  $table='return_products';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
