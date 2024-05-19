@extends('layouts.main')

@section('title', 'Management - Stores')

@push('styles')
<style>
   /*Dropdown carret on select input box*/
   select {
       -webkit-appearance: listbox !important;
   }
</style>
@endpush

@section('pageTitle')

<x-global.page-title page='Management' active='Stores'>
    <button style='background-color: #67BED9;' class='btn btn-sm' data-toggle="modal" data-target="#createStore">
        <span class='text-light' style='font-size: 12px'>
            <i class="bi bi-plus-circle-fill"></i> Add store
        </span>
    </button>
    <x-modals.store.create-store />
</x-global.page-title>

@endsection

@section('content')

<table class="table table-hover table-borderless" style='font-size: 12px'>
  <thead>
    <tr class='border-bottom'>
      <th scope="col">S/N</th>
      <th scope="col">NAME</th>
      <th scope="col">EXTENSION</th>
      <th scope="col">ACTIONS</th>
    </tr>
  </thead>

  <tbody>

      @php $counter = 1; @endphp

      @foreach($stores as $store)

      <tr>
        <th scope="row">{{ $counter }}</th>
        <td>{{ $store->store_name }}</td>
        <td>{{ $store->extension }}</td>
        <td>

          <i type='button'
             style='color: green;padding-right: 7px'
             class="bi bi-pencil-square"
             data-toggle="modal"
             data-target="#editStoreModal{{ $store->id }}"></i>

          <i type='button'
             style='color: red;padding-right: 7px'
             class="bi bi-trash3"
             data-toggle="modal"
             data-target="#deleteStore{{ $store->id }}"></i>
        </td>
      </tr>

      <x-modals.store.edit-store :store="$store" />
      <x-modals.store.delete-store :store="$store" />

      @php $counter ++; @endphp

      @endforeach


  </tbody>

  </table>

@endsection
