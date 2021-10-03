@extends('main') @section('title', 'My Order') @section('content')
<main class="w-3/4 mx-auto" x-data="{ showModal: false }">
    <h1 class="font-bold text-2xl">Order #{{ $order->id }}</h1>
    <p>Order Status: {{ $order->status }}</p>
    <hr>
    @foreach ($products as $product)
    <div class="flex p-4">
        <div class="w-1/2">
            <img src="{{ productImage($product->image) }}" class="rounded-lg w-40" alt="product">

        </div>
        <div class="w-1/2">
            <div>
                <p class="font-bold text-xl mb-4">{{ $product->name }}</p>
                <p class="text-justify mb-8">{{ $product->description }}</p>
            </div>
            <div class="flex">
                <p class="mr-12"><span class="font-bold">Quantity</span> {{ $product->pivot->quantity }}</p>
                <p><span class="font-bold">Price</span> {{ presentPrice($product->price) }}</p>
            </div>
        </div>
    </div>
    <div>
        @if ($product->pivot->count() > 1)
        <p class="underline mb-2">Additional Information</p>
        @if ($product->pivot->weight_in_pound)
        <p>Weight: {{ $product->pivot->weight_in_pound }} Pound</p>
        @endif
        @if ($product->pivot->choice)
        <p>Choice: {{ $product->pivot->choice }}</p>
        @endif
        @if ($product->pivot->message)
        <p>Message: {{ $product->pivot->message }}</p>
        @endif
        @endif

    </div>
    <hr>
    @endforeach

    <div class="flex items-center bg-gray-800 p-4 rounded-lg mb-8 text-white mt-8">
        <div class="flex justify-between mr-4 w-1/2">
            <div>
                <p class="font-bold">Billing Address</p>
                <p class="text-sm">{{ $order->street_name }}, {{ $order->address }}</p>
            </div>
            <div>
                <p class="font-bold">Payment Details</p>
                @if (empty($order->payment))
                <p class="text-sm">Payment method: Cash on Delivery</p>
                @else
                <p class="text-sm">Payment method: {{ $order->payment->payment_method }}</p>
                @endif

            </div>
        </div>
        <div class="flex justify-between w-1/2">
            <div>
                <div>
                    <p>Subtotal</p>
                </div>
                <div>
                    <p>Delivery Charge</p>
                </div>
                @if($order->discount)
                <div class="flex">
                    <p>
                        Discount <span class="text-sm">({{ $order->discount_code }})</span>:
                    </p>
                </div>
                @endif
                <div>
                    <p class="font-bold text-xl">Total</p>
                </div>
            </div>
            <div class="text-right">
                <div>
                    <p>{{ presentPrice($order->subtotal) }}</p>
                </div>
                <div>
                    <p>{{ presentPrice(150) }}</p>
                </div>
                @if ($order->discount)
                <div>
                    <p>- {{ presentPrice($order->discount) }}</p>
                </div>
                @endif
                <div>
                    <p class="font-bold text-xl">{{ presentPrice($order->total) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end p-4">
        <button @click="showModal = true" x-show="showModal ==
             false"
            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow focus:outline-none">Cancel
            Order
        </button>

    </div>
    <div class="absolute inset-0 bg-black bg-opacity-60 flex justify-center items-center" x-show="showModal">
        <div class="flex flex-col w-96 bg-white shadow-xl p-8 rounded-lg" @click.away="showModal = false">
            {{--
            <label for="cancellation_reason">Cancellation Reason</label>
            <select name="order_cancellation_reason" class="w-48 mb-4" id="cancellation_reason">
                <option value="select reasons">Select reasons</option>
                <option value="Change of mind">Change of mind</option>
                <option value="Duplicate order">Duplicate order</option>
                <option value="Change of delivery">Change of delivery</option>
            </select>
            <label for="comments">Additional Comments</label>
            <textarea name="comments" id="comments" class="mb-4">
            </textarea> --}}

            <p class="mb-4">Are you sure you want to cancel this order?</p>
            <div class="flex justify-between">
                <form action="{{ route('orders.update',$order->id) }}" method="POST">
                    @csrf
                    <button
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow focus:outline-none">Yes,
                        Cancel
                        Order
                    </button>
                </form>

                <button class="px-4
                    py-2
                    text-white
                    rounded-lg
                    focus:outline-none
                    bg-red-500
                    hover:bg-red-600
                    text-xs
                    xl:text-base" @click="showModal = false">
                    No, I changed my mind
                </button>

            </div>

        </div>


    </div>

</main>
@endsection