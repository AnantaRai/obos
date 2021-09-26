@extends('main') @section('title', 'My Order') @section('content')
<main>
    @if (session()->has('success'))
    <div class="text-center">
        <p class="text-green-500 mb-4">{{ session()->get('success') }}</p>
    </div>
    @endif

    <div class="flex p-2">
        <div class="w-1/4 flex flex-col items-center">
            <a href="{{ route('users.edit') }}" class="mb-2 text-lg flex hover:underline">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                My Profile
            </a>
            <a href="{{ route('orders.index') }}" class="mb-2 text-lg flex hover:underline">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
                My Orders
            </a>
        </div>
        <div class="w-3/4 flex flex-col">
            <h1 class="font-bold text-3xl mb-4">My Orders</h1>
            <hr />
            {{--
            <div>
                @foreach ($orders as $order)
                <div>{{ $order->id }}
        </div>
        <div>{{ presentPrice($order->billing_total) }}</div>
        @foreach ($order->products as $product)
        <div>{{ $product->name }}</div>
        <div>
            <img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="{{ $product->name }}"
                class="rounded-lg w-40" />
        </div>
        @endforeach @endforeach
    </div>
    --}}
    <div class="mt-8">
        @forelse($orders as $order)
        <table class="table-fixed w-full mb-6">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="border px-4 py-2 text-lg">ID</th>
                    <th class="border px-4 py-2 text-lg">
                        Ordered Items
                    </th>
                    <th class="border px-4 py-2 text-lg">Total</th>
                    <th class="border px-4 py-2 text-lg">
                        Order Placed
                    </th>
                    <th class="border px-4 py-2 text-lg">
                        Order Details
                    </th>
                </tr>
            </thead>
            <tbody class="text-center bg-gray-100">
                <tr>
                    <td class="border px-4 py-2">{{ $order->id }}</td>
                    <td class="border px-4 py-2 flex flex-col">
                        @foreach ($order->products as $product)
                        <img src="{{ productImage($product->image) }}" class="rounded-lg w-10" alt="product">

                        <div>
                            <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                        </div>
                        <hr />
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">
                        {{ presentPrice($order->total) }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ presentDate($order->created_at) }}
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('orders.show', $order->id) }}">View order details</a>
                    </td>
                </tr>
            </tbody>
        </table>
        @empty
        <div class="h-96">
            <p class="text-lg">No orders yet!</p>
        </div>
        @endforelse
    </div>
    </div>
    </div>
</main>
@endsection