@extends('public.layout.main')

@section('content')
<section class="py-10 flex items-center justify-center px-4 bg-white">
    <div class="w-full max-w-md bg-white p-8 rounded-xl">

        <h2 class="text-3xl font-semibold text-gray-900 mb-2 text-center">Create New Password</h2>
        <p class="text-gray-500 text-center mb-8">
            Your new password must be different from previously used passwords.
        </p>

        <form action="#" method="POST" class="space-y-6">
            @csrf

            <!-- New Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1">New Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password"
                        id="newPassword"
                        placeholder="Enter new password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 pr-12 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none"
                        oninput="checkStrength()"
                    >

                    <!-- Eye Icon -->
                    <span 
                        class="absolute right-3 top-3 cursor-pointer flex items-center"
                        onclick="togglePassword('newPassword', 'eye1open', 'eye1close')"
                    >
                        <!-- Open Eye -->
                        <svg id="eye1open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600 hidden" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 
                                7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        <!-- Closed Eye -->
                        <svg id="eye1close" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>

                    </span>
                </div>

                <!-- Strength Bar -->
                <div class="flex items-center gap-3 mt-2">
                    <div class="w-full h-2 bg-gray-200 rounded-full">
                        <div id="strengthBar" class="h-2 bg-red-500 rounded-full w-0"></div>
                    </div>
                    <span id="strengthText" class="text-sm font-semibold"></span>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1">Confirm New Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password_confirmation"
                        id="confirmPassword"
                        placeholder="Confirm new password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 pr-12 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none"
                        oninput="validateMatch()"
                    >

                    <!-- Eye Icon -->
                    <span 
                        class="absolute right-3 top-3 cursor-pointer flex items-center"
                        onclick="togglePassword('confirmPassword', 'eye2open', 'eye2close')"
                    >
                        <!-- Open -->
                        <svg id="eye2open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600 hidden" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 
                                7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        <!-- Closed -->
                        <svg id="eye2close" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </span>
                </div>
                <p id="matchText" class="text-sm mt-1"></p>
            </div>

            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 transition text-white font-medium py-3 rounded-lg">
                Reset Password
            </button>

        </form>
    </div>
</section>

<script>
    function togglePassword(inputId, openId, closeId) {
        let input = document.getElementById(inputId);
        let openEye = document.getElementById(openId);
        let closeEye = document.getElementById(closeId);

        if (input.type === "password") {
            input.type = "text";
             closeEye.classList.add("hidden");
             openEye.classList.remove("hidden");
        } else {
            input.type = "password";
            openEye.classList.add("hidden");
            closeEye.classList.remove("hidden");
        }
    }

    function checkStrength() {
        let password = document.getElementById("newPassword").value;
        let bar = document.getElementById("strengthBar");
        let text = document.getElementById("strengthText");

        let strength = 0;
        if (password.length >= 6) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        let widths = ["10%", "40%", "60%", "100%"];
        let colors = ["red", "orange", "#1DAA40", "green"];
        let labels = ["Weak", "Fair", "Good", "Strong"];

        bar.style.width = widths[strength - 1] || "0";
        bar.style.backgroundColor = colors[strength - 1] || "red";
        text.innerHTML = labels[strength - 1] || "";
        text.style.color = colors[strength - 1] || "red";
    }

    function validateMatch() {
        let pass = document.getElementById("newPassword").value;
        let confirm = document.getElementById("confirmPassword").value;
        let msg = document.getElementById("matchText");

        if (confirm.length === 0) {
            msg.innerHTML = "";
            return;
        }

        if (pass === confirm) {
            msg.innerHTML = "Passwords match";
            msg.className = "text-green-600 text-sm";
        } else {
            msg.innerHTML = "Passwords do not match";
            msg.className = "text-red-600 text-sm";
        }
    }
</script>

@endsection
