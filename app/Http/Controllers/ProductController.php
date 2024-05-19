<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();

        return view('management.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(ProductRequest $request)
    // {
    //     $request->validated();
    //
    //     $product = new Product();
    //     $product->product_name = $request->input('product_name');
    //     $product->store_id = $request->input('store_id');
    //     $product->description = $request->input('product_description');
    //     $product->cost_price = $request->input('cost_price');
    //     $product->selling_price = $request->input('selling_price');
    //     $product->quantity = $request->input('quantity');
    //     $product->manufacturing_date = $request->input('manufacturing_date');
    //     $product->expiry_date = $request->input('expiry_date');
    //     if($request->quantity > 0) {
    //         $status = 'In Stock';
    //     }else {
    //         $status = 'Sold Out';
    //     }
    //     $product->status = $status;
    //
    //     $product->save();
    //
    //     return redirect()->back()->with('success', 'Record has been updated succesfully');
    // }


    public function store(ProductRequest $request)
    {
        
        $request->validated();

            // Find the store in the database
            $store = Store::where('store_name', 'GATAKA SUPERMARKET')->first();
            // Check if the store exists
            if ($store) {

                 $product = new Product();
                 $product->product_name = $request->input('product_name');
                 $product->store_id = $store->id;
                 $product->description = $request->input('product_description');
                 $product->cost_price = $request->input('cost_price');
                 $product->selling_price = $request->input('selling_price');
                 $product->quantity = $request->input('quantity');
                 $product->manufacturing_date = $request->input('manufacturing_date');
                 $product->expiry_date = $request->input('expiry_date');
                if($request->quantity > 0) {
                    if ($request->quantity < 50) {
                        $status = 'Restock Needed';
                    } else {
                        $status = 'In Stock';
                    }
                } else {
                    $status = 'Sold Out';
                }
                $product->status = $status;

                $product->save();            

                return redirect()->back()->with('success', 'Record has been updated succesfully');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $store, Product $product)
    {
        $request->validated();

        $prod = Product::find($product->id);
        $prod->product_name = $request->input('product_name');
        $prod->store_id = $request->input('store_id');
        $prod->description = $request->input('product_description');
        $prod->cost_price = $request->input('cost_price');
        $prod->selling_price = $request->input('selling_price');
        $prod->quantity = $request->input('quantity');
        $prod->manufacturing_date = $request->input('manufacturing_date');
        $prod->expiry_date = $request->input('expiry_date');
        if($request->quantity > 0) {
            if ($request->quantity < 50) {
                $status = 'Restock Needed';
            } else {
                $status = 'In Stock';
            }
        } else {
            $status = 'Sold Out';
        }
        $prod->status = $status;

        $prod->save();

        return redirect()->back()->with('success', 'Record has been updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($store, Product $product)
    {

        $product->delete();

        return redirect()->back()->with('success', 'Record has been deleted succesfully');
    }
}
