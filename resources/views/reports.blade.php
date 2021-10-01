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
@foreach ($topProducts as $product)
<div style="width: 75%; margin: 0 auto;">
    <img src="{{ productImage($product->image) }}" style="width: 200px" alt="product">
    <p>{{ $product->name }}</p>
</div>
<hr>
@endforeach
@else
<h1>No Products yet</h1>
@endif


@stop