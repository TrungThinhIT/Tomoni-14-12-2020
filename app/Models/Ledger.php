<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];
    protected $table = 'accountant_socai';
}
