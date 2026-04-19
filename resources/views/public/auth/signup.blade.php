@extends('public.layout.main')
@section('content')

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#f8fafc]">
        
        <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-2xl shadow-lg border border-gray-100">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Create your account</h2>
                <p class="text-sm text-gray-500">Join us today and explore new opportunities.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" id="signup-form">
                @csrf
                
                <div class="space-y-5">
                    
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" class="mb-1.5 block text-sm font-medium text-gray-700" />
                        <x-text-input id="name" class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" type="text" name="name" :value="old('name')" autofocus required autocomplete="name" placeholder="John Doe" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="mb-1.5 block text-sm font-medium text-gray-700" />
                        <x-text-input id="email" class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="mb-1.5 block text-sm font-medium text-gray-700" />
                        <div class="relative rounded-lg shadow-sm">
                            <x-text-input id="password" class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors pr-10" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-primary focus:outline-none transition-colors" onclick="togglePassword('password', 'icon-pw')" aria-label="Toggle password visibility">
                                <svg id="icon-pw" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-1.5 block text-sm font-medium text-gray-700" />
                        <div class="relative rounded-lg shadow-sm">
                            <x-text-input id="password_confirmation" class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors pr-10" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-primary focus:outline-none transition-colors" onclick="togglePassword('password_confirmation', 'icon-pw-conf')" aria-label="Toggle confirm password visibility">
                                <svg id="icon-pw-conf" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-500" />
                    </div>

                    <!-- Account Type Section -->
                    <div class="mt-4 pt-2">
                        <label class="mb-2 block text-sm font-semibold text-gray-900">Account Type</label>
                        <div class="flex items-start p-4 border border-gray-200 rounded-lg bg-gray-50 hover:bg-gray-100 hover:border-primary/30 transition-all cursor-pointer" onclick="document.getElementById('radio_investor').click()">
                            <div class="flex items-center h-5 mt-0.5">
                                <input id="radio_investor" name="role" type="radio" value="investor" checked required class="w-4 h-4 text-primary bg-white border-gray-300 focus:ring-primary focus:ring-2">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="radio_investor" class="font-medium text-gray-900 cursor-pointer block">Investor Account</label>
                                <p class="text-gray-500 mt-0.5 cursor-pointer leading-relaxed">I want to join the platform to explore investments.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Submit Button CTA -->
                <button type="submit" id="submit-btn" class="w-full mt-8 py-3.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 flex justify-center items-center disabled:opacity-75 disabled:cursor-wait">
                    <span id="btn-text">Create Account</span>
                    <svg id="btn-loader" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>

                <!-- Footer Text -->
                <div class="mt-8 text-center border-t border-gray-100 pt-6">
                    <p class="text-[13px] text-gray-500 mb-5 leading-relaxed">
                        By creating an account, you agree to our <br>
                        <a href="#" class="text-primary hover:text-primary-dark font-medium transition-colors">Terms of Service</a> and 
                        <a href="#" class="text-primary hover:text-primary-dark font-medium transition-colors">Privacy Policy</a>.
                    </p>
                    <p class="text-sm font-medium text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-bold text-primary hover:text-primary-dark transition-colors ml-1">Log In</a>
                    </p>
                </div>

            </form>
        </div>
    </div>

    <!-- UI Scripts -->
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
                icon.classList.add('text-primary');
            } else {
                input.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
                icon.classList.remove('text-primary');
            }
        }

        document.getElementById('signup-form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            const loader = document.getElementById('btn-loader');
            const text = document.getElementById('btn-text');
            
            btn.disabled = true;
            loader.classList.remove('hidden');
            text.innerText = 'Creating account...';
        });
    </script>
@endsection
