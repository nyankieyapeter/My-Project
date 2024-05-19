<!--Delete Modal -->
<div class="modal fade" id="deleteOrderModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete this user?</h5>
        <button type="button" class="btn close" style="font-size: 29px; color: gray" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <form action="{{ route('order.destroy', ['store' => session('selected_store'), 'order' => $order->id]) }}"
           method="POST">
         @csrf
         @method('DELETE')
         <div class="modal-body">
            <div class="row">
                <span class='fw-bold'>
                   Order Invoice Number : {{ $order->order_invoice }}
                </span>
             </div>
         </div>

         <div class="modal-footer">
             <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn-sm btn btn-danger">Delete Order</button>
         </div>
     </form>
    </div>
  </div>
</div>

