<!--Delete Modal -->
<div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Delete this product?</h5>
        <button type="button" class="btn close" style="font-size: 29px; color: gray" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <form action="{{ route('product.destroy', ['store' => session('selected_store'), 'product' => $product->id]) }}"
           method="POST">
         @csrf
         @method('DELETE')
         <div class="modal-body">
            <span class='fw-bold'>
                Name : {{ $product->product_name }}
                <br>
                Description : {{ $product->description }}
            </span>
         </div>

         <div class="modal-footer">
             <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn-sm btn btn-danger">Delete Supplier</button>
         </div>
     </form>
    </div>
  </div>
</div>

