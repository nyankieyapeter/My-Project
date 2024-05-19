@extends('layouts.main')

@section('title', 'Management - Product')

@push('styles')

<style>
  .custom-modal .modal-dialog {
    max-width: 42%; /* Adjust the width as per your requirement */
  }

   .form-control::placeholder {
       color: gray;
   }
</style>

@endpush

@section('pageTitle')

@hasanyrole('admin|Super Admin')
<x-global.page-title page='Management' active='Stock Inventory'>
    <button style='background-color: #67BED9;' class='btn btn-sm' data-toggle="modal" data-target="#createProduct">
        <span class='text-light' style='font-size: 12px'>
            <i class="bi bi-plus-circle-fill"></i> Add product
        </span>
    </button>
    <x-modals.product.create-product />
</x-global.page-title>
@endhasanyrole


@endsection

@section('content')

<table style='font-size: 12px' id="example" class="mt-4 table table-striped" style="width:100%">
        <thead>
            <x-global.data-table-td />
        </thead>
        <tbody>

         @php $counter = 1; @endphp
         @foreach($products as $product)
            <tr>
                <td class='fw-bold'>{{ $counter }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ date('F jS, Y',strtotime($product->expiry_date)) }}</td>
                <td>{{ $product->selling_price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                <span class="
                    @if($product->status == 'Restock Needed') badge bg-warning
                    @elseif($product->status == 'In Stock') badge bg-success
                    @elseif($product->status == 'Sold Out') badge bg-danger
                    @endif
                    ">
                        {{ $product->status }}
                    </span>
                </td>
                @role(['admin', 'manager', 'Super Admin'])
                <td>
                    <i type='button'
                       style='color: green;padding-right: 7px'
                       class="bi bi-pencil-square"
                       data-toggle="modal"
                       data-target="#editProductModal{{ $product->id }}"></i>

                    <i type='button'
                       style='color: red;padding-right: 7px'
                       class="bi bi-trash3"
                       data-toggle="modal"
                       data-target="#deleteProductModal{{ $product->id }}"></i>
                </td>
                @endrole
            </tr>

        <x-modals.product.edit-product :product="$product" />
        <x-modals.product.delete-product :product="$product" />

        @php $counter++ @endphp
        @endforeach

        </tbody>
        <tfoot>
            <x-global.data-table-td />
        </tfoot>
    </table>

@endsection

@push('scripts')
@endpush
