<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() {

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
        return view('reports.index', [
            'todaySales' => $todaySales
        ]);
    }

    public function getOrdersData(Request $request)
    {
        // Define your query here based on the filter criteria
        $query = Order::query();

        if ($request->has('payment')) {
            $query->where('payment_method', $request->input('payment'));
        }

        if ($request->has('from_date')) {
            $query->whereDate('order_date', '>=', $request->input('from_date'));
        }

        if ($request->has('to_date')) {
            $query->whereDate('order_date', '<=', $request->input('to_date'));
        }

        if ($request->has('attendee')) {
            $query->where('attendee', 'like', '%' . $request->input('attendee') . '%');
        }

        return datatables()
            ->of($query)
            ->make(true);
    }
}
