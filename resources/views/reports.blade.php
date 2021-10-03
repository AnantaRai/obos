@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.__('voyager::generic.bread'))

@section('page_header')
<h1 class="page-title">
    @if ($topProducts->isNotEmpty())
    <div>
        <h3>Top Selling Products</h3>
    </div>
    @endif

</h1>
@stop

@section('content')
@if ($topProducts->isNotEmpty())
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Rank</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity Sold</th>
            <th scope="col">Sales Amount</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($topProducts as $key => $product)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
                <img src="{{ productImage($product->image) }}" style="width: 200px" alt="product">
                <p>Product Name: {{ $product->name }}</p>
                <p>Product Price: NPR {{ $product->price }}</p>

            </td>
            <td>{{ $product->count }}</td>
            <td>NPR {{ $product->count * $product->price }}</td>
        </tr>

        @endforeach
    </tbody>
</table>
@else
<h1>No Products yet</h1>
@endif

@stop