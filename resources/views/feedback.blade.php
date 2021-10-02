@extends('main')
@section('title', 'Feedback')
@section('content')
<main class="flex flex-col justify-center items-center">
    <div>
        <h1 class="font-bold text-3xl mb-4">Give us your feedbacks</h1>
        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="
                        mb-4
                        appearance-none
                        block
                        w-full
                        bg-gray-200
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        px-4
                        leading-tight
                        focus:outline-none
                        focus:bg-white
                        focus:border-gray-500
                    " />
            @error('name')
            <div class="text-md text-red-500">{{ $message }}</div>
            @enderror
            <label for="feedback_email">Email</label>
            <input type="email" name="feedback_email" id="feedback_email" class="
                        mb-4
                        appearance-none
                        block
                        w-full
                        bg-gray-200
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        px-4
                        leading-tight
                        focus:outline-none
                        focus:bg-white
                        focus:border-gray-500
                    " />
            @error('feedback_email')
            <div class="text-md text-red-500">{{ $message }}</div>
            @enderror
            <label for="message">Message</label>
            <textarea class="resize-none border rounded-md w-full" name="message" id="message"></textarea>
            @error('message')
            <div class="text-md text-red-500">{{ $message }}</div>
            @enderror
            <button type="submit" class="
                        mt-4
                        px-4
                        py-2
                        text-white
                        rounded-lg
                        focus:outline-none
                        bg-red-500
                        hover:bg-red-600
                        text-xs
                        xl:text-base
                        mb-4
                    ">
                Submit
            </button>
        </form>
    </div>
</main>
@endsection