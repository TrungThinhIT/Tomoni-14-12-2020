<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $primaryKey = 'id';
    protected $guarded = [];
    protected $table = 'product';

    public function ProductStandard(){
        return $this->belongsTo(ProductStandard::class, 'jan_code', 'jan_code');
    }

    public function Inventory(){
        return $this->hasMany(Inventory::class, 'codeorder', 'codeorder');
    }
}
