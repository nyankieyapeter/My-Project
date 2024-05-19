<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ $order->order_invoice }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

        <div class="row">
            <div class="col-md-6 m-auto" style="text-align: center">
                <strong style="font-size: 24px">{{ $order->store->store_name }}</strong><br>
                <span style="font-size: 14px">{{ $order->created_at->format('F j, Y') }}</span> <br>
                <span style="font-size: 14px">{{ $order->order_invoice }}</span> <br>
                <span style="font-size: 14px">Customer name: {{ $order->customer_name }}</span><br>
                <span style="font-size: 14px">You were served by: {{ $order->attendee }}</span>
            </div>
        </div>

    <div style="padding-top: 10px;padding-bottom: 10px">
         <span style="font-size: 24px;"><strong>
         Order Details
         </strong></span>
    </div>

    <table>
        <thead>
            <tr class="bg-blue">
                <th>Product</th>
                <th>Description</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->product }}</td>
    		    	<td><span>{{ $item->description }}</span></td>
                    <td>Ksh. {{ number_format($item->subtotal/ $item->quantity, '2', '.', ',') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Ksh. {{ number_format($item->subtotal, 2, '.', ',') }}</td>
                </tr>
            @endforeach
               <tr>
                    <td colspan="4" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                    <td colspan="1" class="total-heading">Ksh. {{ number_format($order->total_amount, 2, '.', ',') }}</td>
                </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with us
    </p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
