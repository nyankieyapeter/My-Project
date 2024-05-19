@extends('layouts.auth')


@push('styles')
    <style>
        select {
        -webkit-appearance: listbox !important;
        }
    </style>
@endpush

@section('content')

    <x-auth.login>

        <h2 class="hr-lines" style="font-size: 12px;margin-bottom: 39px">
            <span class="hr-lines-2">
                To which faculty do you want to be redirected
            </span>
        </h2>

        <form method="POST" action="{{ route('store.process.selection',  ['selection' => '']) }}" >
            @csrf

              <div class="col-md-6 m-auto">
                  <div class="form-group">
                      <select id="option" class="form-control" style="font-size: 12px;" name="option">
                          <option value="cafa">GATAKA SUPERMARKET</option>
                          <!-- Add more stores if you want under this, The value option is important and must also be  -->
                          <!-- edited on the StoreSelectionController.php file -->

                          <!-- <option value="cafb">Canteen B</option> -->
                      </select>
                  </div>
              </div>

            <div class="col-md-6 m-auto" style="padding-top: 39px">
                <button
                    type="submit"
                    class="btn btn-sm w-100 text-light"
                    style="background-color: #5A61C4">Proceed</button>
            </div>

        </form>


    </x-auth.login>

@endsection


