@extends('main') @section('title', 'Checkout') @section('content')
@section('stripe-head')
<style>
    .StripeElement {
        background-color: white;
        padding: 16px 16px;
        border: 1px solid #ccc;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    #card-errors {
        color: #fa755a;
    }
</style>
<script src="https://js.stripe.com/v3/"></script>
@endsection
<main>
    <div class="mb-4">
        <h1 class="font-bold text-3xl px-4 xl:px-8 xl:text-3xl xl:text-center">
            Checkout
        </h1>
    </div>
    <hr />
    <div class="px-2 xl:flex xl:justify-between">
        <div class="p-2 xl:p-4 xl:w-1/2">
            <p class="font-bold text-2xl mb-4 text-center">Your Order</p>
            <div class="grid xl:grid-cols-4 xl:p-2 xl:justify-items-center xl:items-center">
                <p></p>
                <p class="font-bold underline">Product</p>
                <p class="font-bold underline">Quantity</p>
                <p class="font-bold underline">Price</p>
            </div>
            @foreach (Cart::content() as $item)
            <div class="
                    grid
                    xl:grid-cols-4
                    xl:p-2
                    xl:justify-items-center
                    xl:items-center
                    mb-4
                ">
                <img src="{{ productImage($item->model->image) }}" class="rounded-lg w-20" alt="product">
                <p class="ml-2">{{ $item->model->name }}</p>
                <p>{{ $item->qty }}</p>
                <p>NPR <span>{{ $item->price }}</span></p>
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
            <hr />
            @endforeach
            <div class="flex justify-between">
                <div>
                    <div>
                        <p>Subtotal</p>
                    </div>

                    <div>
                        <p>Delivery charge</p>
                    </div>
                    @if (session()->has('coupon'))
                    <div class="flex">
                        <p>
                            Discount
                            <span class="text-sm">({{ session()->get('coupon')['name'] }})</span>:
                        </p>
                    </div>
                    @endif
                    <div>
                        <p class="font-bold">Total</p>
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
                        <p class="font-bold">{{ presentPrice($newTotal) }}</p>
                    </div>
                </div>
            </div>
            <hr />
            <p class="mt-4 text-red-500">
                *Currently delivery only available inside kathmandu valley
            </p>
        </div>
        <div class="p-4 xl:w-1/2">
            <h2 class="font-bold text-2xl mb-4 text-center">Billing Details</h2>
            <form action="{{ route('checkout.store') }}" id="payment-form" method="POST" x-data="{ selected: 'cod'}">
                @csrf
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="
                        mb-4
                        appearance-none
                        block
                        w-full
                        bg-gray-200
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        px-4
                        leading-tight
                        focus:outline-none
                        focus:bg-white
                        focus:border-gray-500
                    " value="{{ auth()->user()->name }}" readonly />
                @error('name')
                <div class="text-xs text-red-500">{{ $message }}</div>
                @enderror

                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="
                        mb-4
                        appearance-none
                        block
                        w-full
                        bg-gray-200
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        px-4
                        leading-tight
                        focus:outline-none
                        focus:bg-white
                        focus:border-gray-500
                    " value="{{ auth()->user()->email }}" readonly />
                @error('email')
                <div class="text-xs text-red-500">{{ $message }}</div>
                @enderror
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="
                        mb-4
                        appearance-none
                        block
                        w-full
                        bg-gray-200
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        px-4
                        leading-tight
                        focus:outline-none
                        focus:bg-white
                        focus:border-gray-500
                    " value="{{ old('address') }}" />
                @error('address')
                <div class="text-xs text-red-500">{{ $message }}</div>
                @enderror
                <label for="street_name">Street Name</label>
                <input type="text" name="street_name" id="street_name" class="
                        mb-4
                        appearance-none
                        block
                        w-full
                        bg-gray-200
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        px-4
                        leading-tight
                        focus:outline-none
                        focus:bg-white
                        focus:border-gray-500
                    " value="{{ old('street_name') }}" />
                @error('street_name')
                <div class="text-xs text-red-500">{{ $message }}</div>
                @enderror


                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="
                        mb-4
                        appearance-none
                        block
                        w-full
                        bg-gray-200
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        px-4
                        leading-tight
                        focus:outline-none
                        focus:bg-white
                        focus:border-gray-500
                    " value="{{ old('phone') }}" />
                @error('phone')
                <div class="text-xs text-red-500">{{ $message }}</div>
                @enderror
                <h2 class="font-bold text-2xl mb-4 text-center">
                    Payment Details
                </h2>

                <div class="mb-4 flex flex-col">
                    <div class="flex flex-col justify-center">
                        <label for="cod" class="mb-4">
                            <input type="radio" name="payment_method" id="cod" value="cod" x-model="selected"
                                {{ old('payment_method') == "cod" ? "checked" : '' }}>
                            <span class="font-bold text-md">Cash On Delivery</span>
                        </label>

                        <div x-show="selected == 'cod' " class="bg-gray-800 h-16 grid place-items-center rounded-lg">
                            <p class="text-white">Pay with cash upon delivery.</p>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center">
                        <label for="card" class="mb-4">
                            <input type="radio" name="payment_method" id="card" value="card" x-model="selected"
                                {{ old('payment_method') == "card" ? "checked" : '' }}>
                            <span class="font-bold text-md">Credit or Debit card</span>
                        </label>
                        <div x-show="selected == 'card'">
                            <label for="name_on_card">Name on Card</label>
                            <input type="text" name="name_on_card" id="name_on_card" class="
                                mb-4
                                appearance-none
                                block
                                w-full
                                bg-gray-200
                                text-gray-700
                                border border-gray-200
                                rounded
                                py-3
                                px-4
                                leading-tight
                                focus:outline-none
                                focus:bg-white
                                focus:border-gray-500
                            " value="{{ auth()->user()->name }}" readonly />
                            <label for="card-element"> Credit or debit card </label>
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    @error('payment_method')
                    <div class="text-xs text-red-500">{{ $message }}</div>
                    @enderror
                </div>




                <button type="submit" class="
                        mt-4
                        px-4
                        py-2
                        text-white
                        rounded-lg
                        focus:outline-none
                        bg-red-500
                        hover:bg-red-600
                        text-xs
                        xl:text-base
                    " id="complete-order">
                    Complete Order
                </button>
            </form>
        </div>
    </div>
</main>
@endsection @section('stripe-foot')
<script>
    (function () {
        // Create a Stripe client
        var stripe = Stripe(
            "pk_test_51IksvYAkMa0mGtiRhtTEm2AhoKJT7br1VtdvOCNP8KRoZbCqbLPzlyP1Lv17GsQYWPzLvUFoYdYcW8pjzDTdK20H002Q98xhaS"
        );
        // Create an instance of Elements
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                color: "#32325d",
                lineHeight: "18px",
                fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4",
                },
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a",
            },
        };
        // Create an instance of the card Element
        var card = elements.create("card", {
            style: style,
            hidePostalCode: true,
        });
        // Add an instance of the card Element into the `card-element` <div>
        card.mount("#card-element");
        // Handle real-time validation errors from the card Element.
        card.addEventListener("change", function (event) {
            var displayError = document.getElementById("card-errors");
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = "";
            }
        });
        // Handle form submission
        var form = document.getElementById("payment-form");
        form.addEventListener("submit", function (event) {
            var card_payment = document.getElementById("card");
            if(card_payment.checked) {
                    var options = {
                    name: document.getElementById("name_on_card").value,
                    address_line1: document.getElementById("address").value,
                };
                document.getElementById("complete-order").disabled = true;
                event.preventDefault();

                stripe.createToken(card, options).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById("card-errors");
                        errorElement.textContent = result.error.message;

                        document.getElementById("complete-order").disabled = false;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            }
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById("payment-form");
            var hiddenInput = document.createElement("input");
            hiddenInput.setAttribute("type", "hidden");
            hiddenInput.setAttribute("name", "stripeToken");
            hiddenInput.setAttribute("value", token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    })();
</script>
@endsection