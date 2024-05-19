<!--Edit Modal -->
<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
        <button type="button" class="btn close" style="font-size: 29px; color: gray" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     <form action="{{ route('user.store', ['store' => session('selected_store')]) }}"
           method="POST">
         @csrf
         <div class="modal-body">
             <div class="row">
             <div class="col-md-12 mt-2">
                 <div class="form-group">
                     <label class="fw-bold" for="supplier_name" style="font-size: 12px">Fullname</label>
                     <input required
                         name='user_name'
                         value="{{ old('user_name') }}"
                         type="text" class="form-control @error('user_name') is-invalid @enderror"
                         style="font-size: 12px">
                 </div>
             </div>
             <div class="col-md-12 mt-2">
                 <div class="form-group">
                     <label class="fw-bold" for="username" style="font-size: 12px">Username</label>
                     <input required
                         name='username'
                         value="{{ old('username') }}"
                         type="text" class="form-control @error('username') is-invalid @enderror"
                         style="font-size: 12px">
                 </div>
             </div>
             <div class="col-md-12 mt-2">
                 <div class="form-group">
                     <label class="fw-bold" for="user_email" style="font-size: 12px">E-Mail</label>
                      <input required
                         name='user_email'
                         value="{{ old('user_email') }}"
                         type="email" class="form-control @error('user_email') is-invalid @enderror"
                         style="font-size: 12px">
                 </div>
             </div>
             <div class="col-md-12 mt-2">
                 <div class="form-group">
                     <label class="fw-bold" for="user_password" style="font-size: 12px">Password</label>
                      <input
                         name='user_password'
                         value="{{ old('user_password') }}"
                         type="password" class="form-control @error('user_password') is-invalid @enderror"
                         style="font-size: 12px">
                 </div>
             </div>
             <div class="col-md-6 mt-2">
                 <div class="form-group">
                    <label class="fw-bold" for="store_id" style="font-size: 12px">Role</label>
                    <select name="user_role" class="form-control" style="font-size: 12px">
                        @role('admin|Super Admin')
                        <option value="admin">admin</option>
                        <option value="manager">manager</option>
                        @endrole
                        <option value="cashier">cashier</option>
                    </select>
                 </div>
             </div>
             <div class="col-md-6 mt-2">
                 <div class="form-group">
                    <label class="fw-bold" for="store_id" style="font-size: 12px">Store</label>
                    <select required name="store_id" class="form-control" style="font-size: 12px">
                        @foreach(App\Models\Store::all() as $store)
                            <option  value="{{ $store->id }}"}}>
                                {{ $store->store_name }}
                            </option>
                        @endforeach
                    </select>
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

