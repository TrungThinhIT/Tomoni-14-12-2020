<?php

namespace App\Services\Warehouses;

use App\Models\Bill;
use App\Models\Product;

class ExportedService {

    public function index(){
        $codeorders = Bill::where('deleted_at', null)->select('Codeorder')->distinct()->with('Product')->get();
        dd($codeorders);
    }
}

?>