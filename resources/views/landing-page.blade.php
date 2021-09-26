@extends('main')
@section('title', 'Home')
@section('content')
<main class="mb-4 flex flex-col items-center">
    <h3 class="font-bold text-2xl text-center mb-2 sm:text-xl xl:text-3xl">
        Featured
    </h3>
    <section class="grid grid-cols-1 mb-4 sm:grid-cols-3 xl:grid-cols-4">
        @foreach ($products as $product)
        <div class="mb-4">
            <a href="{{ route('shop.show', $product->slug) }}">
                <div class="p-4">
                    <img src="{{ productImage($product->image) }}" class="rounded-lg" alt="product">
                </div>
                <div class="flex flex-col items-center">
                    <p class="font-bold text-lg sm:text-base">{{ $product->name }}</p>
                    <p class="sm:text-sm text-green-600">{{ $product->presentPrice()}}</p>
                </div>
            </a>
        </div>
        @endforeach
    </section>
    <div class="mb-8">
        <a href="{{ route('shop.index') }}" class="px-4 py-2 text-white rounded-lg bg-red-500 hover:bg-red-600">View
            more products</a>
    </div>
</main>
@endsection