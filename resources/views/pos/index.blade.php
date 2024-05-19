@extends ('layouts.main')

@section('title', 'Management - Users')

@push('styles')
    <style>
        label {
            font - size: 13px;
        }

        .form-control::placeholder {
            color: gray;
        }

        /*Dropdown carret on select input box*/
        select {
            -webkit - appearance: listbox !important;
        }
    </style>
@endpush

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pos.viewproduct', ['store' => session('selected_store')]) }}" method="POST" id="product-form">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_name">Customer Name</label>
                                <input type="text" class="form-control" value="" placeholder="e.g John Doe" name="customer_name" style="font-size: 12px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_phone">Customer's Phone Number</label>
                                <input type="number" class="form-control" placeholder="e.g 011234567" value="" name="customer_phone" style="font-size: 12px">
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group row">
                                <label for="product_name" class="col-sm-4 col-form-label" style="font-size: 13px">Select Product</label>
                                <div class="col-sm-8">
                                  <input
                                    class="awesomplete form-control"
                                    style="width: 292px; font-size: 12px;"
                                    name="product_name"
                                    data-maxitems="10"
                                    data-autofirst
                                    data-list='@foreach($products as $product) {{ $product->product_name }} - {{ $product->description }}, @endforeach' />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <button class='btn  btn-sm' type="submit" style="background-color: #4356F1">
                            <span class='text-light' style='font-size: 12px'>
                                <i class="bi bi-plus-circle-fill"></i> Add cart
                            </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped mt-4" id="data-products" style="font-size: 12px">
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Per unit</td>
                        <td>In stock</td>
                        <td>Quantity Purchased</td>
                        <td>Subtotal</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 fw-bold col-form-label">Grand Total</label>
                            <div class="col-sm-8">
                                <input type="number" name="grandtotal" id="grandtotal" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-2">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 fw-bold col-form-label">Payment</label>
                            <div class="col-sm-8">
                                <select name="payment" class="form-control" id="payment">
                                    <option value="M-Pesa">M-Pesa</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="float-end mt-3">
                    <button class="btn text-light" id="pos_btn" style="width: 190px;background-color: #4356F1" type="submit">
                        <i id="spinner" class="fa fa-spinner fa-spin" style="display: none;"></i> Submit
                    </button>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>

        let counter = 1,
            grandtotal = 0;

        $('#product-form').submit(function(e) {
            e.preventDefault();

            let form = $(this),
                target = e.target.action,
                form_data = form.serialize();

            $.ajax({
                type: "GET",
                url: target,
                data: form_data,
                cache: false,
                success: function(response) {

                    let product_name = response.name,
                        price = response.price,
                        quantity = response.quantity,
                        status = response.status,
                        row = "<tr id='row_" + counter + "'>" +
                            "<td><input type='hidden' name='product_id' value='"+response.id+"'> " + product_name + "</td> " +
                            "<td><span id='price_" + counter + "'>" + price + "</span></td> " +
                            "<td>" + quantity + "</td> " +
                            "<td><input style='font-size:12px' class='form-control quantity-input' type='number' name='quantity' data-id='" + counter + "' min='1' max='" + quantity + "' value='1'></td> " +
                            "<td><span id='subtotal_" + counter + "'>" + price + "</span> <input id='sub_total_"+counter+"' value='" + price + "' type='hidden' name='subtotal' ></td>" +
                            "<td><i class='bi bi-trash3 text-danger' data-id='" + counter + "' style='cursor: pointer' onclick='deleteproduct($(this))'></i></td>" +
                            "</tr>";

                    grandtotal += price;
                    $('#grandtotal').val(grandtotal);
                    $('#data-products').append(row);
                    counter++;
                },
                error: function(error) {
                    console.log(error)
                }
            });
        });

        $(document).on('change', '.quantity-input', function() {
            let quantity = $(this).val(),
                row_id = $(this).data('id'),
                price = parseFloat($('#price_' + row_id).text()), // Get the price from the span
                subtotal = parseFloat($('#subtotal_' + row_id).text()), // Get the current subtotal from the span
                new_subtotal = quantity * price;

            $('#subtotal_' + row_id).text(new_subtotal); // Update the subtotal span
            $('#sub_total_' + row_id).val(new_subtotal);

            grandtotal -= subtotal; // Subtract the old subtotal
            grandtotal += new_subtotal; // Add the new subtotal
            $('#grandtotal').val(grandtotal);
        });

        function deleteproduct(item) {
            let row_id = item.data('id');
            $('#row_' + row_id).remove();
        }


        $('#pos_btn').on('click', function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Show the spinner
            $('#spinner').show();

            let customer_name = $('input[name="customer_name"]').val(),
                customer_phone = $('input[name="customer_phone"]').val(),
                grandtotal = $('#grandtotal').val(),
                payment = $('#payment').val(),
                products = $('input[name="product_id"]'),
                products_id =[],
                quantity=[],
                sub_total =[];

            products.each(function (){
                products_id.push($(this).val());
            });

            $('input[name="quantity"]').each(function (){
                quantity.push($(this).val());
            });

            $('input[name="subtotal"]').each(function (){
                sub_total.push($(this).val());
            });


            // return false;

            // Send the order data to the server
            $.ajax({
                type: "POST",
                url: "{{ route('pos.store', ['store' => session('selected_store')]) }}",
                data: {
                    customer_name: customer_name,
                    customer_phone: customer_phone,
                    grandtotal: grandtotal,
                    payment: payment,
                    products: products_id, // Include the list of products
                    quantity: quantity,
                    sub_total: sub_total,

                },
                cache: false,
                success: function(response) {
                    console.log(response);

                    // Hide the spinner when the request is complete
                    $('#spinner').hide();

                    // Clear input fields or provide feedback to the user
                    if (response.success) {
                        // Clear input fields and product rows
                        $('input[name="customer_name"]').val('');
                        $('input[name="customer_phone"]').val('');
                        $('#grandtotal').val('');
                        $('.product-row').remove();

                        // Provide a success message (you can use toastr or other methods)
                        toastr.success('Order submitted successfully.');
                        window.location.href = response.path;
                    } else {
                        // Handle the case where the request was not successful
                        toastr.error('An error seems to have occurred. Please try again');
                    }
                },
                error: function(error) {
                    console.log(error);
                    // Hide the spinner if there's an error
                    $('#spinner').hide();

                    if (error.responseJSON && error.responseJSON.errors) {
                        // Check for specific validation errors
                        if (error.responseJSON.errors.customer_name) {
                            toastr.error(error.responseJSON.errors.customer_name[0]);
                        } else if (error.responseJSON.errors.customer_phone) {
                            toastr.error(error.responseJSON.errors.customer_phone[0]);
                        } else {
                            toastr.error('An error seems to have occurred. Please try again');
                        }
                    } else {
                        toastr.error('An error seems to have occurred. Please try again');
                    }
                }
            });
        });

    </script>
@endpush
