<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductGetController extends Controller
{
    public function viewproduct(Request $request) {

    $product_name = explode('-', $request->input('product_name'));

    $production_info = Product::where('product_name', $product_name[0])->where('description', trim($product_name[1]))->get()[0];

    return [
        'id' => $production_info['id'],
        'name' => $production_info['product_name'],
        'price' => $production_info['selling_price'],
        'quantity' => $production_info['quantity'],
        'status' => $production_info['status'],
    ];

    }

}
