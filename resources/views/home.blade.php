@extends('layouts.main')

@section('title', 'Dashboard')

@push('styles')

@endpush

@section('content')

<div class="pagetitle border-bottom" style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Dashboard</h1>
</div>

<x-global.cards :todaySales="$todaySales" />

<div class="row">

    <x-home.resource-card :icon="'bi bi-receipt'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Today's Invoices</small></p>
    	<h4 class="my-1" style="font-size: 14px;color: black"><small><strong>{{ $todayinvoices }}</strong></small></h4>
    </x-home.resource-card>

    <x-home.resource-card :icon="'bi bi-calendar2'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Current Months Sales</small></p>
    	<h4 class="my-1" style="font-size: 14px;color: black"><small><strong>Ksh.{{ $currentMonthSales }}.00</strong></small></h4>
    </x-home.resource-card>

    <x-home.resource-card :icon="'bi bi-calendar2-minus'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Last 3 Months Sales</small></p>
    	<h4 class="my-1" style="font-size: 14px;color: black"><small><strong>Ksh.{{ $last3MonthsSales }}.00</strong></small></h4>
    </x-home.resource-card>

    <x-home.resource-card :icon="'bi bi-calendar3'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Last 6 Months Sales</small></p>
    	<h4 class="my-1" style="font-size: 14px;color: black"><small><strong>Ksh.{{ $last6MonthsSales }}.00</strong></small></h4>
    </x-home.resource-card>

    @role('admin|Super Admin')
    <x-home.resource-card :icon="'bi bi-people'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Users</small></p>
        <h4 class="my-1" style="font-size: 14px;color: black"><small><strong>
            {{ \App\Models\User::count() }}
        </strong></small></h4>
    </x-home.resource-card>
    @endrole

    <x-home.resource-card :icon="'bi bi-box-seam'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Available Products</small></p>
        <h4 class="my-1" style="font-size: 14px;color: black"><small><strong>
            @if(session('selected_store') == 'cafa')
                {{ \App\Models\Product::where('store_id', 1)->count() }}
            @elseif(session('selected_store') == 'cafb')
                {{ \App\Models\Product::where('store_id', 2)->count() }}
            @endif
        </strong></small></h4>
    </x-home.resource-card>

    <x-home.resource-card :icon="'bi bi-bank'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Current Year Revenue</small></p>
    	<h4 class="my-1" style="font-size: 14px;color: black"><small><strong>Ksh.{{ $currentYearRevenue }}.00</strong></small></h4>
    </x-home.resource-card>

    @role('admin|Super Admin')
    <x-home.resource-card :icon="'bi bi-building'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Stores</small></p>
        <h4 class="my-1" style="font-size: 14px;color: black"><small><strong>
            {{ \App\Models\Store::count() }}
        </strong></small></h4>
    </x-home.resource-card>
    @endrole

    @role('admin|Super Admin')
    <x-home.resource-card :icon="'bi bi-building-fill-up'">
    	<p class="mb-0" style="font-size: 14px;color: gray"><small>Suppliers</small></p>
        <h4 class="my-1" style="font-size: 14px;color: black"><small><strong>1</strong></small></h4>
    </x-home.resource-card>
    @endrole
</div>

<div class="row">
    <div class="card">
        <div class="card-header">
            <span><strong>Today's</strong></span>
            <span style="color: red"><strong>({{ \Carbon\Carbon::now()->format('l jS F, Y') }})</strong></span>
            <span><strong>Transactions</strong></span>
        </div>
        <div class="card-body" style="padding-top: 15px">
            <table style='font-size: 12px' id="example" class="mt-4 table table-striped" style="width:100%">

                    <thead>
                        <tr style='font-size: 10px'>
                            <th>S/N</th>
                            <th>INVOICE</th>
                            <th>CUSTOMER</th>
                            <th>AMOUNT</th>
                            <th>ATTENDEE</th>
                            <th>METHOD</th>
                        </tr>
                    </thead>
                    <tbody>

                     @php $counter = 1; @endphp
                     @foreach($orders as $order)
                        <tr>
                            <td class='fw-bold'>{{ $counter }}</td>
                            <td><a href="{{ route('invoice.show', ['store' => session('selected_store'), 'invoice' => $order->id]) }}">{{ $order->order_invoice }}</a></td>
                            <td>{{ $order->customer_name }}</td>
                            <td>Ksh.{{ $order->total_amount }}.00</td>
                            <td>{{ $order->attendee }}</td>
                            <td >
                            <span class="badge
                                @if($order->method == 'M-Pesa')
                                bg-primary
                                @elseif($order->method == 'Cash')
                                bg-secondary
                                @endif">
                                    {{ $order->method }}
                                </span>
                            </td>
                        </tr>


                    @php $counter++ @endphp
                    @endforeach

                    </tbody>
                    <tfoot>
                        <tr style='font-size: 10px'>
                           <th>S/N</th>
                           <th>INVOICE</th>
                           <th>CUSTOMER</th>
                           <th>AMOUNT</th>
                           <th>ATTENDEE</th>
                           <th>METHOD</th>
                        </tr>
                    </tfoot>
                </table>

        </div>
    </div>
</div>
@endsection
