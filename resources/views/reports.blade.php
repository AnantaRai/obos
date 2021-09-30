@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.__('voyager::generic.bread'))

@section('page_header')
<h1 class="page-title">
    <div>
        <h3>Top Selling Products</h3>
    </div>
</h1>
@stop

@section('content')
@foreach ($topProducts as $product)
<div style="width: 75%; margin: 0 auto;">
    <img src="{{ productImage($product->image) }}" style="width: 200px" alt="product">
    <p>{{ $product->name }}</p>
</div>
<hr>
@endforeach

@stop