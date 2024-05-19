<!--Edit Modal -->
<div class="modal fade custom-modal" id="editProductModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product Details</h5>
        <button type="button" class="btn close" style="font-size: 29px; color: gray" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <form action="{{ route('product.update', ['store' => session('selected_store'), 'product' => $product->id]) }}"
           method="POST">
         @csrf
         @method('PATCH')
         <div class="modal-body">
            <div class="row">

                <div class="col-md-6 mb-2">
                   <div class="form-group">
                       <label for="product_name" class="fw-bold" style="font-size: 11px;">Product Name</label>
                        <input
                           required
                           placeholder="e.g cakes"
                           name='product_name'
                           value="{{ old('product_name', $product->product_name) }}"
                           type="text" class="form-control @error('product_name') is-invalid @enderror"
                           style="font-size: 12px">
                   </div>
                </div>

                <div class="col-md-6 mb-2">
                   <div class="form-group">
                       <label for="product_description" class="fw-bold" style="font-size: 11px">Product Description</label>
                        <input
                           required
                           name='product_description' placeholder="e.g cakes 50g"
                           value="{{ old('product_description', $product->description) }}"
                           type="text" class="form-control @error('product_description') is-invalid @enderror"
                           style="font-size: 12px">
                   </div>
                </div>

                <div class="col-md-4 mb-2">
                   <div class="form-group">
                       <label for="cost_price" class="fw-bold" style="font-size: 11px">Cost Price (unit price)</label>
                        <input
                           required
                           name='cost_price' placeholder="e.g 200"
                           value="{{ old('cost_price', $product->cost_price) }}"
                           type="text" class="form-control @error('cost_price') is-invalid @enderror"
                           style="font-size: 12px">
                   </div>
                </div>

                <div class="col-md-4 mb-2">
                   <div class="form-group">
                       <label for="selling_price" class="fw-bold" style="font-size: 11px">Selling Price (unit price)</label>
                        <input
                           required
                           name='selling_price' placeholder="e.g 250"
                           value="{{ old('selling_price', $product->selling_price) }}"
                           type="text" class="form-control @error('selling_price') is-invalid @enderror"
                           style="font-size: 12px">
                   </div>
                </div>

                <div class="col-md-4 mb-2">
                   <div class="form-group">
                       <label for="quantity" class="fw-bold" style="font-size: 11px">Quantity (Cartons)</label>
                        <input
                           required
                           name='quantity' placeholder="e.g 10"
                           value="{{ old('quantity', $product->quantity) }}"
                           type="text" class="form-control @error('quantity') is-invalid @enderror"
                           style="font-size: 12px">
                   </div>
                </div>

                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="store_id" class="fw-bold" style="font-size: 11px">Canteen</label>
                        <select required name="store_id" class="form-control" style="font-size: 12px;-webkit-appearance: listbox !important;">
                            @foreach(App\Models\Store::all() as $store)
                                <option value="{{ $store->id }}" {{ $product->store->id == $store->id ? 'selected' : '' }}>
                                    {{ $store->store_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                   <div class="form-group">
                       <label for="manufacture_date" class="fw-bold" style="font-size: 11px">Manufacture Date</label>
                        <input
                           required
                           name='manufacturing_date'
                           class="form-control"
                           value="{{ old('manufacturing_date', $product->manufacturing_date) }}"
                           type="datetime-local"
                           style="font-size: 12px">
                   </div>
                </div>

                <div class="col-md-6 mb-2">
                   <div class="form-group">
                       <label for="expiry_date" class="fw-bold" style="font-size: 11px">Expiry Date</label>
                        <input
                           required
                           class="form-control"
                           name='expiry_date'
                           value="{{ old('expiry_date', $product->expiry_date) }}"
                           type="datetime-local"
                           style="font-size: 12px">
                   </div>
                </div>

            </div>
         </div>

         <div class="modal-footer">
             <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn-sm btn btn-primary">Save changes</button>
         </div>
     </form>
    </div>
  </div>
</div>

