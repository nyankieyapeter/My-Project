@extends('layouts.main')

@section('title', 'Management - Sales Information')

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
    <x-global.page-title page='Management' active='Sales Information' />
@endsection

@section('content')

<table style='font-size: 12px' id="example" class="mt-4 table table-striped" style="width:100%">
        <thead>
            <tr style='font-size: 10px'>
                <th>S/N</th>
                <th>INVOICE</th>
                <th>CUSTOMER</th>
                <th>PHONE NO</th>
                <th>TOTAL</th>
                <th>ATTENDEE</th>
                <th>STATUS</th>
                <th>METHOD</th>
                @role(['admin|Super Admin'])

                @endrole
                @role(['admin','manager'])
                <th>ACTIONS</th>
                @endrole
            </tr>
        </thead>
        <tbody>

         @php $counter = 1; @endphp
         @foreach($orders as $order)
            <tr class="fw-bold">
                <td class='fw-bold'>{{ $counter }}</td>
                <td><a href="{{ route('invoice.show', ['store' => session('selected_store'), 'invoice' => $order->id]) }}">{{ $order->order_invoice }}</a></td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>{{ $order->attendee }}</td>
                <td>
                    <span class="{{ $order->status == 'Paid' ? 'badge bg-success' : 'badge bg-danger' }}">
                        {{ $order->status }}
                    </span>
                </td>
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
                @role(['admin','manager'])
                <td style="text-align: center; vertical-align: middle;">
                    <i type='button'
                       style='color: red;padding-right: 7px'
                       class="bi bi-trash3"
                       data-toggle="modal"
                       data-target="#deleteOrderModal{{ $order->id }}"></i>
                </td>
                @endrole
            </tr>

        <x-modals.order.delete-order :order="$order" />

        @php $counter++ @endphp
        @endforeach

        </tbody>
        <tfoot>
            <tr style='font-size: 10px'>
               <th>S/N</th>
               <th>INVOICE</th>
               <th>CUSTOMER</th>
               <th>PHONE NO</th>
               <th>TOTAL</th>
               <th>ATTENDEE</th>
               <th>STATUS</th>
               <th>METHOD</th>
                @role(['admin'])
                @endrole
                @role(['admin','manager'])
               <th>ACTIONS</th>
               @endrole
            </tr>
        </tfoot>
    </table>

@endsection

@push('scripts')
@endpush
