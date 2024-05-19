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
    <livewire:order-table/>
@endunlessrole

@hasanyrole('admin|Super Admin')
    <livewire:admin-order-table/>
@endhasanyrole

@endsection
