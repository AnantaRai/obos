@extends('main')
@section('title', $product->name)
@section('content')
<main>
    <div class="flex justify-between items-center mb-8 mx-4 px-4">
        <div class="flex items-center mb-4 mx-4 px-4 w-6/12">
            <a href="{{ route('landing-page') }}">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('shop.index') }}">Shop</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <p>{{ $product->name }}</p>
        </div>
        @livewire('product-search-bar')
    </div>
    @if ($product->category->name == "Cakes")
    <div class="grid sm:gap-4 sm:grid-cols-1 xl:grid-cols-2 p-8 mb-4"
        x-data="{ productPrice: {{ $product->price }}, activeWeight: 1, activeChoice: 1 }">
        <div>
            <img src="{{ productImage($product->image) }}" class="rounded-lg" alt="product">
        </div>
        <div>
            <h2 class="font-bold text-3xl mb-8">{{ $product->name }}</h2>
            <p class="mb-8">
                {!! $product->description !!}
            </p>
            <p class="my-8 text-green-600 font-bold">NPR <span x-text="productPrice"></p>
            </p>

            <div class="mb-8" id="size">
                <p class="mb-4 font-bold">Weight</p>
                <button
                    :class="activeWeight == 1 ? 'px-4 py-2 focus:outline-none rounded border border-red-500 mr-2' : 'px-4 py-2 focus:outline-none rounded border border-gray-300 mr-2' "
                    @click="activeWeight = 1; productPrice = {{ $product->price }}"
                    :disabled="activeWeight == 1 ? true : false">1
                    Pound</button>
                <button
                    :class="activeWeight == 2 ? 'px-4 py-2 focus:outline-none rounded border border-red-500 mr-2' : 'px-4 py-2 focus:outline-none rounded border border-gray-300 mr-2' "
                    @click="activeWeight = 2; productPrice = {{ $product->price }}; productPrice *= 2"
                    :disabled="activeWeight == 2 ? true : false">2
                    Pound</button>
                <button
                    :class="activeWeight == 3 ? 'px-4 py-2 focus:outline-none rounded border border-red-500 mr-2' : 'px-4 py-2 focus:outline-none rounded border border-gray-300 mr-2' "
                    @click="activeWeight = 3; productPrice = {{ $product->price }}; productPrice *= 3"
                    :disabled="activeWeight == 3 ? true : false">3
                    Pound</button>
            </div>

            <div class="mb-8">
                <p class="mb-4 font-bold">Choice</p>
                <button
                    :class="activeChoice == 1 ? 'px-4 py-2 focus:outline-none rounded border border-red-500 mr-2' : 'px-4 py-2 focus:outline-none rounded border border-gray-300 mr-2' "
                    @click="activeChoice = 1; productPrice -= 200"
                    :disabled="activeChoice == 1 ? true : false">Normal</button>
                <button
                    :class="activeChoice == 2 ? 'px-4 py-2 focus:outline-none rounded border border-red-500 mr-2' : 'px-4 py-2 focus:outline-none rounded border border-gray-300 mr-2' "
                    @click="activeChoice = 2; productPrice += 200"
                    :disabled="activeChoice == 2 ? true : false">Eggless</button>
                <input type="hidden" name="choice" :value="activeChoice == 1 ? 'Normal' : 'Eggless'">

            </div>
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" :value="productPrice">
                <input type="hidden" name="weight" :value="activeWeight == 1 ? 1 : activeWeight == 2 ? 2 : 3">
                <input type="hidden" name="choice" :value="activeChoice == 1 ? 'Normal' : 'Eggless'">
                <input type="hidden" name="category" value="cakes">
                <div class="mb-8">
                    <label for="message" class="block font-bold">What to write on this cake?</label>
                    <input type="text" name="message" id="message" class="w-1/2"
                        placeholder="Eg: Happy Birthday to John Doe">
                </div>
                <button type="submit"
                    class="px-4 py-2 text-white rounded-lg bg-red-500 hover:bg-red-600 focus:outline-none">Add to
                    cart</button>
            </form>
        </div>
    </div>
    @else
    <div class="grid sm:gap-4 sm:grid-cols-1 xl:grid-cols-2 p-8 mb-4">
        <div>
            <img src="{{ productImage($product->image) }}" class="rounded-lg" alt="product">
        </div>
        <div>
            <h2 class="font-bold text-3xl mb-8">{{ $product->name }}</h2>
            <p class="mb-8">
                {{ $product->description }}
            </p>
            <p class="mb-8 text-green-600">{{ $product->presentPrice() }}</p>
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <button type="submit"
                    class="px-4 py-2 text-white rounded-lg bg-red-500 hover:bg-red-600 focus:outline-none">Add to
                    cart</button>
            </form>
        </div>
    </div>
    @endif

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