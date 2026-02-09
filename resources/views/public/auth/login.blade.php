@extends('public.layout.main')
@section('content')
    <section class="py-10 flex items-center justify-center px-4 bg-red-5000">
        <div class="w-full max-w-md bg-white p-8 rounded-xl ">

            <!-- Title -->
            <h2 class="text-3xl font-semibold text-gray-900 mb-8 text-center">Login to your account</h2>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 transition text-white font-medium py-3 rounded-lg mt-4">
                    Log In
                </button>

            </form>
        </div>
    </section>
@endsection
