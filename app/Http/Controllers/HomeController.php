<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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

            // Retrieve orders for the selected cafe created today
            $orders = Order::whereHas('store', function ($query) use ($storeName) {
                $query->where('store_name', $storeName);
            })->whereDate('created_at', Carbon::today())->get();

            // Calculate today's date
            $today = Carbon::now()->format('Y-m-d');

            // Retrieve today's sales for the selected store
            $todaySales = Order::whereDate('created_at', Carbon::today())
                ->whereHas('store', function ($query) use ($storeName) {
                    $query->where('store_name', $storeName);
            })->sum('total_amount');
        }

        $currentMonthSales = Order::sales('current_month')->sum('total_amount');
        $last3MonthsSales = Order::sales('last_3_months')->sum('total_amount');
        $last6MonthsSales = Order::sales('last_6_months')->sum('total_amount');
        $currentYearRevenue = Order::sales('current_year')->sum('total_amount');
        $todayinvoices = Order::whereDate('created_at', Carbon::today())->count();

        return view('home', [
            'currentMonthSales' => $currentMonthSales,
            'last3MonthsSales' => $last3MonthsSales,
            'last6MonthsSales' => $last6MonthsSales,
            'currentYearRevenue' => $currentYearRevenue,
            'todayinvoices' => $todayinvoices,
            'todaySales' => $todaySales,
            'orders' => $orders
        ]);
    }

    public function updatePassword($store, $profile,  Request $request) {
        // Get the current user
        $user = User::find($profile);

        // Check if the provided current password matches the user's current password
        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->with(['error' => 'An error occured please try again.']);
        }

        // Check if the new password and confirmed password match
        if ($request->input('newpassword') !== $request->input('renewpassword')) {
            return redirect()->back()->with(['error' => 'The new password and confirmed password do not match.']);
        }

        // Update the user's password with the new password
        $user->update([
            'password' => Hash::make($request->input('newpassword')),
        ]);

        // Redirect the user with a success message
        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
