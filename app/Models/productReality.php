<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productReality extends Model
{
    use HasFactory;
    protected $table = 'product_reality';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
