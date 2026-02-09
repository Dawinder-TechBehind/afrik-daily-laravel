@extends('public.layout.main')
@section('content')


    <section class="py-10 flex items-center justify-center px-4 bg-red-5000">
        <div class="w-full max-w-md bg-white p-8 rounded-xl ">

            <!-- Title -->
            <h2 class="text-3xl font-semibold text-gray-900 mb-8 text-center">Create your account</h2>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        autofocus required autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="role" :value="__('Role')" />

                    <input type="radio" name="role" value="investor" class="m-2" checked required>Investor
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 transition text-white font-medium py-3 rounded-lg mt-4">
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
