<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devv_xaphuongthitran extends Model
{
    use HasFactory;
    protected $table = 'devvn_xaphuongthitran';
    protected $primaryKey = 'xaid';
    public $timestamps = false;
    
}
