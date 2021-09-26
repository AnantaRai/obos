@extends('main')
@section('content')
<main class="h-96 flex flex-col justify-center items-center">
    <h1 class="font-bold text-lg">Transaction Failed!</h1>
    <a href="{{ route('landing-page') }}"
        class="px-4 py-2 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600 focus:outline-none">
        Home
    </a>
</main>
@endsection