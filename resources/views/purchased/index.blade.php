@extends('layouts.main')

@section('title', 'Dashboard')

@push('styles')
<style>
tbody {
    font-size: 14px;
}
</style>
@endpush

@section('content')

<div class="pagetitle border-bottom" style="display: flex; justify-content: space-between; align-items: center;">
    <span>
    <strong style="font-size: 19px">
        <i class="bi bi-graph-down"></i>
       <span style="color: #4154F1">Sales Reports for the month of {{ \Carbon\Carbon::now()->format('F, Y') }}</span>
    </strong>
    </span>
</div>
<x-global.cards :todaySales="$todaySales" />

@unlessrole('admin|Super Admin')

<div style="color: #7993CB">
    <span><strong>Records for </strong></span>
    <span style="color: red"><strong>
        @if (session('selected_store') == 'cafa')
            {{ "GATAKA SUPERMARKET's" }}
        @elseif (session('selected_store') == 'cafb')
            {{ "Canteen B's" }}
        @endif
    </strong></span>
    <span><strong>Purchased Products</strong></span>
</div>

<livewire:purchased-table/>
@endunlessrole

@hasanyrole('admin|Super Admin')

<div style="color: #7993CB">
    <span><strong>Records for </strong></span>
    <span style="color: red"><strong>
        {{ "GATAKA SUPERMARKET's" }}
        <span style="color: #7993CB">and</span>
        {{ "Canteen B's" }}
    </strong></span>
    <span><strong>Purchased Products</strong></span>
</div>

<livewire:admin-purchased-table/>

@endhasanyrole

@endsection
