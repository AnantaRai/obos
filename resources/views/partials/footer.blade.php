<footer class="flex flex-col items-center p-4 bg-purple-700">
    <h1 class="font-bold text-2xl text-center text-white mb-2">
        Subscribe to our newsletter
    </h1>
    <p class="text-white text-sm text-center mb-4">
        Our weekly newsletter provides you with the latest and most important
        happenings in our bakery.
    </p>
    <form action="/newsletter" method="POST" class="flex items-center mb-4">
        @csrf
        <input type="text" name="email"
            class="p-4 text-gray-700 w-full h-4 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0"
            placeholder="Enter your email address" required />

        <button type="submit" class="bg-gray-800 hover:bg-gray-900 rounded-lg text-white px-4 py-2 focus:outline-none">
            Subscribe
        </button>

    </form>
    @error('email')
    <div class="text-md text-red-500">{{ $message }}</div>
    @enderror

    @if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
        class="fixed bg-green-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        <p>{{ session()->get('success') }}</p>
    </div>
    @endif

    <p class="text-white text-center">
        &copy; Cake Street {{ date("Y") }}. All rights reserved.
    </p>
    <a href="{{ route('feedback.create') }}" class="text-white text-center">Give Feedback?</a>
</footer>