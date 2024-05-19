<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchased;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PurchasedController extends Controller
{

    public function index()
    {

        $storeMapping = [
            'cafa' => 'GATAKA SUPERMARKET',
            'cafb' => 'Canteen B',
        ];

        $selectedStore = session('selected_store');


        if (array_key_exists($selectedStore, $storeMapping)) {
            // Get the corresponding store name
            $storeName = $storeMapping[$selectedStore];

            // Calculate today's date
            $today = Carbon::now()->format('Y-m-d');

            // Retrieve today's sales for the selected store
            $todaySales = Order::whereDate('created_at', Carbon::today())
                ->whereHas('store', function ($query) use ($storeName) {
                    $query->where('store_name', $storeName);
            })->sum('total_amount');
        }

        return view('purchased.index', [
            'todaySales' => $todaySales
        ]);
    }


    public function show($store, Order $invoice)
    {
        $purchased_items = Purchased::where('order_id', $invoice->id)->get();
        return view('invoice.show', [
            'items' => $purchased_items,
            'order' => $invoice
        ]);
    }

    public function print($store, Order $invoice)
    {
        $purchased_items = Purchased::where('order_id', $invoice->id)->get();
        return view('invoice.show', [
            'items' => $purchased_items,
            'order' => $invoice
        ]);
    }

    public function generateinvoice($store, Order $invoice) {

        $items = Purchased::where('order_id', $invoice->id)->get();

        $data = ['order' => $invoice, 'items' => $items];

        $pdf = Pdf::loadView('invoice.print', $data);

        return $pdf->download($invoice->order_invoice.'.pdf');

    }

}
