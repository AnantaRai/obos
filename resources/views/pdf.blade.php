<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
    <title>Pdf</title>
</head>

<body>
    <h1 class="text-center font-bold text-4xl mb-4">Cake Street</h1>
    <h4 class="text-center">Order Details</h4>
    <table class="table-auto border-collapse border w-3/4 mx-auto mb-8">
        <tbody>
            <tr>
                <td class="border border-black font-bold p-2">Products</td>
                <td class="border border-black">
                    @foreach ($products as $product)
                    <div class="flex p-4 border-b-2 border-black">
                        <div>
                            <img src="{{ productImage($product->image) }}" alt="product" class="w-28 mr-4">
                        </div>
                        <div>
                            <p><span class="font-bold">Product Name:</span> {{ $product->name }}</p>
                            <p><span class="font-bold">Product Price:</span> NPR {{ $product->price }}</p>
                            <p><span class="font-bold">Product Quantity:</span> {{ $product->quantity }}</p>
                            @if ($product->pivot->count() > 1)
                            @if ($product->pivot->weight_in_pound)
                            <p><span class="font-bold">Weight:</span>{{ $product->pivot->weight_in_pound }} Pound</p>
                            @endif
                            @if ($product->pivot->choice)
                            <p><span class="font-bold">Choice:</span>{{ $product->pivot->choice }}</p>
                            @endif
                            @if ($product->pivot->message)
                            <p><span class="font-bold">Message:</span>{{ $product->pivot->message }}</p>
                            @endif
                            @endif
                        </div>

                    </div>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Order Id</td>
                <td class="border border-black p-2">{{ $order->id }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Name</td>
                <td class="border border-black p-2">{{ $order->name }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Email</td>
                <td class="border border-black p-2">{{ $order->email }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Address</td>
                <td class="border border-black p-2">{{ $order->address }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Street Name</td>
                <td class="border border-black p-2">{{ $order->street_name }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Phone</td>
                <td class="border border-black p-2">{{ $order->phone }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Discount</td>
                <td class="border border-black p-2">{{ $order->discount }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Discount Code</td>
                <td class="border border-black p-2">{{ $order->discount_code }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Subtotal</td>
                <td class="border border-black p-2">{{ $order->subtotal }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Delivery Charge</td>
                <td class="border border-black p-2">NPR {{ $deliveryCharge }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Total</td>
                <td class="border border-black p-2">NPR {{ $order->total }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Status</td>
                <td class="border border-black p-2">{{ $order->status }}</td>
            </tr>
            <tr>
                <td class="border border-black font-bold p-2">Order Placed</td>
                <td class="border border-black p-2">{{ $order->created_at }}</td>
            </tr>

            <tr>
                <td class="border border-black font-bold p-2">Payment Details</td>
                @if (!empty($payment))
                <td class="border border-black p-2">
                    <li><span class="font-bold">Payment Method:</span> {{ $payment->payment_method }}</li>
                    <li><span class="font-bold">Cardholder's Name:</span> {{ $payment->cardholder_name }}</li>
                    <li><span class="font-bold">Transaction ID:</span> {{ $payment->transaction_id }}</li>
                    <li><span class="font-bold">Amount Paid:</span> NPR {{ $payment->amount }}</li>
                </td>
                @else
                <td class="border border-black p-2">
                    <p><span class="font-bold">Payment Method:</span> Cash On Delivery</p>
                </td>
                @endif
            </tr>
        </tbody>
    </table>
</body>

</html>