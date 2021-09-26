@extends('main')
@section('title', 'Thank You')
@section('content')
<main class="h-96 flex flex-col justify-center items-center">
    @if (session()->has('success'))
    <div class="fixed bg-green-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        <p>{{ session()->get('success') }}</p>
    </div>
    @endif
    {{-- <h1 class="font-bold text-lg">Thank you for your order!</h1>
    <p>A confirmation email was sent</p> --}}
    <a href="{{ route('landing-page') }}"
        class="px-4 py-2 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600 focus:outline-none">
        Home
    </a>
</main>
@endsection