@extends('public.layout.main')

@section('content')
<section class="py-12 flex items-center justify-center px-4 bg-white">
    <div class="w-full max-w-md bg-white p-8 rounded-xl">

        <!-- Title -->
        <h2 class="text-3xl font-semibold text-gray-900 mb-3">Forgot Password?</h2>

        <p class="text-gray-500 mb-8 leading-relaxed">
            No problem. Enter the email address associated with your account and we will send you a link to reset your password.
        </p>

        <!-- Form -->
        <form action="#" method="POST" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-1">Email Address</label>

                <div class="relative">
                    <input 
                        type="email" 
                        name="email"
                        placeholder="you@example.com"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 pr-12 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none"
                    >

                    <!-- Email Icon -->
                    <span class="absolute right-3 top-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke-width="1.5" 
                             stroke="currentColor" 
                             class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 transition text-white font-medium py-3 mt-2 rounded-lg">
                Send Reset Link
            </button>

        </form>
    </div>
</section>
@endsection
