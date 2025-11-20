@extends('public.layout.main')
@section('content')
<section class="py-10 flex items-center justify-center px-4 bg-red-5000">
    <div class="w-full max-w-md bg-white p-8 rounded-xl ">
        
        <!-- Title -->
        <h2 class="text-3xl font-semibold text-gray-900 mb-8 text-center">Login to your account</h2>

        <!-- Form -->
        <form action="#" method="POST" class="space-y-5">

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                <input type="email" placeholder="Enter your email address"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" placeholder="Enter your password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <!-- Submit Button -->
            <button type="button"
                class="w-full bg-green-500 hover:bg-green-600 transition text-white font-medium py-3 rounded-lg">
                Log In
            </button>

        </form>
    </div>
</section>

@endsection