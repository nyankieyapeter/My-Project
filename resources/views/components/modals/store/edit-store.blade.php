<!--Edit Modal -->
<div class="modal fade" id="editStoreModal{{ $store->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category Details</h5>
        <button type="button" class="btn close" style="font-size: 29px; color: gray" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <form action="{{ route('store.update', ['store' => session('selected_store'), 'stor' => $store->id]) }}"
           method="POST">
         @csrf
         @method('PATCH')
         <div class="modal-body">
             <div class="row">
             <div class="col-md-6">
                 <div class="form-group">
                    <label for="store_name" style="font-size: 12px">STORE NAME</label>
                    <input
                        required
                        name='store_name'
                        value="{{ old('store_name', $store->store_name ) }}"
                        type="text" class="form-control @error('store_name') is-invalid @enderror"
                        style="font-size: 12px">
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-group">
                     <label for="extension" style="font-size: 12px">EXTENSION</label>
                      <input
                         required
                         name='extension'
                         value="{{ old('extension', $store->extension ) }}"
                         type="text" class="form-control @error('extension') is-invalid @enderror"
                         style="font-size: 12px">
                 </div>
             </div>
         </div>
         </div>

         <div class="modal-footer">
             <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn-sm btn btn-success">UPDATE</button>
         </div>
     </form>
    </div>
  </div>
</div>

