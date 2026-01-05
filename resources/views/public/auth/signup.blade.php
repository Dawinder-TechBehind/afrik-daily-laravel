@extends('public.layout.main')
@section('content')
    <section class="py-10 flex items-center justify-center px-4 bg-red-5000">
        <div class="w-full max-w-md bg-white p-8 rounded-xl ">

            <!-- Title -->
            <h2 class="text-3xl font-semibold text-gray-900 mb-8 text-center">Create your account</h2>

            <!-- Form -->
            <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                @csrf
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" placeholder="Enter your full name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none"
                        name="name">
                </div>
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <input type="email" placeholder="Enter your email address" name="email"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" placeholder="Enter your password" name="password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" placeholder="Confirm your password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 transition text-white font-medium py-3 rounded-lg">
                    Sign Up
                </button>

                <!-- Bottom Text -->
                <p class="text-xs text-gray-500 text-center mt-3">
                    By clicking "Sign Up", you agree to our
                    <a href="#" class="text-green-600 font-medium">Terms of Service</a>
                    and
                    <a href="#" class="text-green-600 font-medium">Privacy Policy</a>.
                </p>

            </form>
        </div>
        
    </section>

    
@endsection
