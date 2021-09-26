@extends('main')
@section('title', 'Products')
@section('content')
<main class="mb-4">
    <div class="flex justify-between">
        <div class="flex items-center mb-4 mx-4 px-4 w-6/12">
            <a href="{{ route('landing-page') }}">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <p>Shop</p>
        </div>
        @livewire('product-search-bar')
    </div>

    <div class="xl:flex">
        <div class="flex flex-col m-8">
            <p class="font-bold text-xl mb-8">Categories</p>
            @foreach ($categories as $category)
            <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                class="{{ setActiveCategory($category->slug) }} hover:underline">{{ $category->name }}</a>
            @endforeach
        </div>
        <div>
            <h3 class="font-bold text-2xl text-center mb-2 sm:text-xl xl:text-3xl">
                {{ $categoryName }}
            </h3>
            <section class="grid grid-cols-1 sm:grid-cols-3 xl:grid-cols-4">
                @forelse ($products as $product)
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
                @empty
                <div class="h-96">
                    <p class="text-lg">No items found</p>
                </div>
                @endforelse
            </section>
        </div>
    </div>
</main>
@endsection