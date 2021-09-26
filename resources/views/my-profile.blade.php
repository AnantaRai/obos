@extends('main')
@section('title', 'My Profile')
@section('content')
    <main class="h-screen">
        @if (session()->has('success'))
        <div class="text-center">
            <p class="text-green-500 mb-4">{{ session()->get('success') }}</p>
        </div>
        @endif

        {{-- @if (count($errors) > 0)
        <div class="text-center">
            @foreach ($errors->all() as $error)
            <p class="text-red-500 font-bold mb-4">{{ $error }}</p>
            @endforeach
        </div>
        @endif --}}
        <div class="flex">
            <div class="w-1/4 flex flex-col items-center">
                <a href="{{ route('users.edit') }}" class="mb-2 text-lg flex hover:underline">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    My Profile
                </a>
                <a href="{{ route('orders.index') }}" class="mb-2 text-lg flex hover:underline">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    My Orders
                </a>
            </div>
            <div class="w-3/4 flex flex-col">
                <h1 class="font-bold text-3xl mb-4">My Profile</h1>
                <hr>
                <div class="w-1/2 mt-8">
                    <form action="{{ route('users.update') }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="text-lg">Name</label>
                            <input type="text" name="name" id="name" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" value="{{ old('name', $user->name) }}">
                        </div>
                        @error('name')
                            <div class="text-red-500 mb-4">{{ $message }}</div>
                        @enderror
                        <div class="mb-4" class="text-lg">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" value="{{ old('email', $user->email) }}">
                        </div>
                        @error('email')
                            <div class="text-red-500 mb-4">{{ $message }}</div>
                        @enderror
                        <div>
                            <label for="password" class="text-lg">Password</label>
                            <input type="password" name="password" id="password" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                        </div>
                        <div class="mb-4">
                            <p class="text-sm text-yellow-500">Leave password field blank to keep the current password</p>
                        </div>
                        @error('password')
                            <div class="text-red-500 mb-4">{{ $message }}</div>
                        @enderror
                        <div class="mb-8">
                            <label for="password_confirmation" class="text-lg">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                        </div>
                        @error('confirm_password')
                            <div class="text-red-500 mb-4">{{ $message }}</div>
                        @enderror
                        <x-button>
                           Update Profile
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection