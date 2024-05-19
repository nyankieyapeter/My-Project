<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Purchased;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('pos.index', [
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

    public function store(Request $request)
    {

        // Validate the request data
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'grandtotal' => 'required|numeric',
            'payment' => 'required|string',
        ]);

        // Map the session value to the corresponding store name
        $storeMapping = [
            'cafa' => 'GATAKA SUPERMARKET',
            'cafb' => 'Canteen B',
        ];

        $selectedStore = session('selected_store');

        $products = $request->input('products');
        $subtotal = $request->input('sub_total');
        $quantity = $request->input('quantity');

        // Check if the session value exists in the mapping
        if (array_key_exists($selectedStore, $storeMapping)) {

            $storeName = $storeMapping[session('selected_store')];

            // Find the store in the database
            $store = Store::where('store_name', $storeName)->first();

            // Check if the store exists
            if ($store) {

                try {

                    DB::beginTransaction();

                    $order = new Order();
                    $order->customer_name = $request->input('customer_name');
                    $order->customer_phone = $request->input('customer_phone');
                    $order->total_amount = $request->input('grandtotal');
                    $order->method = $request->input('payment');
                    $order->store_id = $store->id;
                    $order->status = 'Paid';
                    $order->attendee = Auth()->user()->name;
                    $order->save();

                    foreach($products as $key => $product) {
                        $product_name = Product::where('id', $product)->first();
                        $purchased = new Purchased();
                        $purchased->product = $product_name->product_name;
                        $purchased->description = $product_name->description;
                        $purchased->customer_name = $request->input('customer_name');
                        $purchased->attendee = Auth()->user()->name;
                        $purchased->store = $store->store_name;
                        $purchased->quantity = $quantity[$key];
                        $purchased->subtotal = $subtotal[$key];
                        $purchased->order_id = $order->id;
                        $purchased->save();
                    }

                    DB::commit();

                    return [
                        'path'=> route('invoice.show', ['store' => session('selected_store'), 'invoice' => $order->id ]),
                        'success' =>true,
                    ];
                }catch(\Exception $e) {

                    DB::rollBack();

                    return back()->with('error', 'Some details seemed to have been mismatched. Please try again');
                }

            } else {
                // Handle the case where the store doesn't exist.
                return response()->json(['message' => 'Store not found'], 404);
            }
        } else {
            // Handle the case where the session value doesn't match any mapping.
            return response()->json(['message' => 'Invalid store selection'], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
