@extends('public.layout.main')

@section('content')
<section class="py-10 flex items-center justify-center px-4 bg-white">
    <div class="w-full max-w-md p-8 rounded-xl">

        <!-- Title -->
        <h2 class="text-3xl font-semibold text-gray-900 mb-3 text-center">Verify Your Account</h2>
        <p class="text-gray-600 text-center mb-8">
            We've sent a 6-digit code to your registered phone number.
        </p>

        <!-- OTP Form -->
        <form action="#" method="POST" class="space-y-6">
            @csrf

            <!-- OTP Inputs -->
            <div class="flex justify-between gap-3">
                @for ($i = 1; $i <= 6; $i++)
                <input 
                    type="text" 
                    maxlength="1"
                    name="otp[]"
                    class="w-12 h-14 text-center text-xl font-semibold border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-400 outline-none"
                    {{-- oninput="moveNext(this)" --}}
                />
                @endfor
            </div>

            <!-- Resend OTP -->
            <p class="text-sm text-gray-600 text-center">
                Didn't receive a code?
                <a href="#" class="text-green-600 font-medium">
                    Resend OTP
                </a>
            </p>

            <!-- Submit Button -->
            <button 
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 transition text-white font-medium py-3 rounded-lg">
                Verify
            </button>

        </form>
    </div>
</section>

<!-- Auto move cursor -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll("input[name='otp[]']");

    inputs.forEach((input, index) => {

        // Prevent more than 1 character
        input.addEventListener("input", (e) => {
            const value = input.value.replace(/\D/g, ""); // keep only numbers
            input.value = value.substring(0, 1);

            // Auto move forward if typed a digit
            if (value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        // Handle backspace (mobile + desktop)
        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace") {
                if (input.value === "" && index > 0) {
                    inputs[index - 1].focus();
                }
            }
        });

        // Handle pasting entire OTP
        input.addEventListener("paste", (e) => {
            e.preventDefault();
            const pasted = (e.clipboardData || window.clipboardData)
                .getData("text")
                .replace(/\D/g, "");

            if (pasted.length === 6) {
                inputs.forEach((box, i) => {
                    box.value = pasted[i] || "";
                });
                inputs[5].focus();
            }
        });

        // Fix iOS auto-fill behavior
        input.setAttribute("inputmode", "numeric");
        input.setAttribute("pattern", "[0-9]*");
        input.setAttribute("autocomplete", "one-time-code");
        input.setAttribute("autocorrect", "off");
        input.setAttribute("autocapitalize", "off");
        input.setAttribute("spellcheck", "false");
    });
});
</script>




@endsection
