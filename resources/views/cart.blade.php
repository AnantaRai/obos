@extends('main')
@section('title', 'Shopping Cart')
@section('content')
<main class="xl:w-3/5">
    <div class="flex items-center mb-4 px-4 mx-4">
        <a href="#">Home</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <p>Shopping Cart</p>
    </div>
    <div class="p-2 xl:p-8">
        @if (session()->has('cart_success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="fixed bg-green-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
            <p>{{ session()->get('cart_success') }}</p>
        </div>
        @endif

        @if (count($errors) > 0)
        <div>
            @foreach ($errors->all() as $error)
            <p class="text-red-500 mb-4">{{ $error }}</p>
            @endforeach
        </div>
        @endif
        @if (Cart::count() > 0)
        <h3 class="font-bold text-xl">{{ Cart::count() }} item(s) in shopping cart</h3>
        <hr />
        @foreach (Cart::content() as $item)
        <div class="grid grid-cols-5 xl:p-4 items-center">
            <a href="{{ route('shop.show', $item->model->slug) }}">
                <img src="{{ productImage($item->model->image) }}" class="rounded-lg w-20" alt="product">
            </a>
            <a href="{{ route('shop.show', $item->model->slug) }}">
                <p>{{ $item->model->name }}</p>
            </a>
            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="focus:outline-none">Remove</button>
            </form>
            <select class="mr-4 quantity" data-id="{{ $item->rowId }}">
                @for ($i = 1; $i < 6; $i++) <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
            </select>
            <p>{{ presentPrice($item->subtotal) }}</p>
        </div>
        @if ($item->options->isNotEmpty())
        <div>
            <p class="text-lg font-bold underline">Additional Info</p>
            <div class="flex justify-between">
                <p>Weight: <span>{{ $item->options->weight }}</span> Pound</p>
                <p>Choice: <span>{{ $item->options->choice }}</span></p>
                <p>Message: <span>{{ $item->options->message }}</span></p>
            </div>
        </div>
        @endif

        <hr>
        @endforeach
        <div class="flex justify-between bg-gray-800 p-4 rounded-lg mb-8 text-white">
            <div>
                <div>
                    <p>Subtotal</p>
                </div>
                <div>
                    <p>Delivery Charge</p>
                </div>
                @if (session()->has('coupon'))
                <div class="flex">
                    <p>
                        Discount <span class="text-sm">({{ session()->get('coupon')['name'] }})</span>:
                    </p>
                    <form action="{{ route('coupon.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm focus:outline-none">Remove</button>
                    </form>
                </div>
                @endif
                <div>
                    <p class="font-bold text-xl">Total</p>
                </div>

            </div>
            <div class="text-right">
                <div>
                    <p>{{ presentPrice(Cart::subtotal()) }}</p>
                </div>
                <div>
                    <p>{{ presentPrice($deliveryCharge) }}</p>
                </div>
                @if (session()->has('coupon'))
                <div>
                    <p>- {{ presentPrice($discount) }}</p>
                </div>
                @endif
                <div>
                    <p class="font-bold text-xl">{{ presentPrice($newTotal) }}</p>
                </div>

            </div>
        </div>
        <div class="my-4 text-right">
            @if (!session()->has('coupon'))
            <div>
                <p>Have a coupon code?</p>
                <form action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                    <input type="text" name="coupon_code"
                        class="appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        required />
                    <button
                        class="px-4 py-2 text-white rounded-lg focus:outline-none bg-red-500 hover:bg-red-600 text-xs xl:text-base">
                        Apply coupon
                    </button>
                </form>
                @if (session()->has('coupon_success'))
                <div>
                    <p class="text-green-500 mb-4">{{ session()->get('coupon_success') }}</p>
                </div>
                @endif

                @if (session()->has('coupon_error'))
                <div>
                    <p class="text-red-500 mb-4">{{ session()->get('coupon_error') }}</p>
                </div>
                @endif
            </div>
            @endif
        </div>
        <hr>
        <div class="flex justify-between mt-4">
            <a href="{{ route('shop.index') }}"
                class="px-4 py-2 text-white rounded-lg bg-red-500 hover:bg-red-600 text-xs xl:text-base">
                Continue shopping
            </a>

            <a href="{{ route('checkout.index') }}"
                class="px-4 py-2 text-white rounded-lg bg-red-500 hover:bg-red-600 text-xs xl:text-base">
                Procced to checkout
            </a>
        </div>
        @else
        <div>
            <h3 class="font-bold text-lg mb-4">No items in cart!</h3>
            <a href="{{ route('shop.index') }}"
                class="px-4 py-2 text-white rounded-lg bg-red-500 hover:bg-red-600 text-xs xl:text-base"">Continue Shopping</a>
            </div>
        @endif
    </div>
</main>
<hr>
<div class=" grid xl:grid-cols-4">
                @foreach ($mightAlsoLike as $product)
                <div class="mb-4">
                    <a href="{{ route('shop.show', $product->slug) }}">
                        <div class="p-4">
                            <img src="{{ productImage($product->image) }}" class="rounded-lg" alt="product">
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="font-bold text-lg sm:text-base">{{ $product->name }}</p>
                            <p class="sm:text-sm text-green-600">{{ $product->presentPrice() }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
        </div>
        @endsection
        @section('js')
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            (() => {
            const classname = document.querySelectorAll('.quantity');
            Array.from(classname).forEach((element) => {
                    element.addEventListener('change', () => {
                    const id = element.getAttribute('data-id');
                    axios.patch(`/cart/${id}`, {
                        quantity: element.value
                    })
                    .then((response) => {
                        window.location.href = "{{ route('cart.index') }}"
                    })
                    .catch((error) => {
                        console.log(error);
                        window.location.href = "{{ route('cart.index') }}"
                    });
                })
            })
        })()
        </script>
        @endsection