@extends('public.layout.main')

@section('content')

<section class="py-10 flex items-center justify-center px-4 bg-white">
    <div class="w-full max-w-md bg-white p-6">

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-900 text-center mb-6">
            Create Your Profile
        </h2>

        <!-- Step Indicators -->
        <div class="flex items-center justify-center gap-2 mb-6">
            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
            <span class="w-2 h-2 bg-green-200 rounded-full"></span>
        </div>

        <!-- Profile Photo Upload -->
        <div class="flex flex-col items-center mb-8">
            <div class="relative">
                <!-- Circle Preview -->
                <label for="photoUpload" class="cursor-pointer">
                    <div  class="!w-32 !h-32  flex items-center justify-center overflow-hidden">
                        <img id="previewImage" src="" class="hidden w-full h-full object-cover" />
                        <div id="uploadPlaceholder" style="border: 2px dashed;" class="text-gray-400 flex flex-col items-center rounded-full  !border-2 border-dashed bg-gray-200 p-4 border-gray-300">
                            <!-- Camera Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 fill="none" 
                                 viewBox="0 0 24 24" 
                                 stroke-width="1.5" 
                                 stroke="currentColor" 
                                 class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M6.827 6.175A2.31 2.31 0 0 1 8.54 5h6.92c.88 0 1.692.507 1.713 1.175l.188 1.175h1.723c.966 0 1.75.783 1.75 1.75v8.75c0 .967-.784 1.75-1.75 1.75H4.75A1.75 1.75 0 0 1 3 17.85V8.1c0-.967.784-1.75 1.75-1.75H6.29l.537-1.175Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M15 13.25a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                    </div>
                </label>

                <!-- Hidden Input -->
                <input type="file" id="photoUpload" accept="image/*" class="hidden" onchange="previewPhoto(event)">
            </div>

            <button type="button"
                onclick="document.getElementById('photoUpload').click()"
                class="mt-3 bg-green-100 text-green-700 px-5 py-2 rounded-lg text-sm font-medium hover:bg-green-200 transition">
                Add Photo
            </button>
        </div>

        <!-- Form -->
        <form method="POST" action="#" class="space-y-6">
            @csrf

            <!-- Full Name -->
            <div>
                <label class="text-sm font-semibold text-gray-800 block mb-1">Full Name</label>
                <input type="text"
                    name="name"
                    placeholder="e.g., John Doe"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <!-- Email -->
            <div>
                <label class="text-sm font-semibold text-gray-800 block mb-1">Email</label>
                <input type="email"
                    name="email"
                    placeholder="e.g., john.doe@email.com"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <!-- Phone Number -->
            <div>
                <label class="text-sm font-semibold text-gray-800 block mb-1">Phone Number</label>

                <div class="flex">
                    <select class="border border-gray-300 rounded-l-lg px-3 py-3 bg-gray-50 text-gray-800 focus:ring-2 focus:ring-green-500 focus:outline-none">
                        <option value="+234">+234</option>
                        <option value="+91">+91</option>
                        <option value="+1">+1</option>
                        <option value="+44">+44</option>
                    </select>

                    <input type="text"
                        placeholder="801 234 5678"
                        class="w-full border border-gray-300 border-l-0 rounded-r-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
            </div>

            <!-- Address -->
            <div>
                <label class="text-sm font-semibold text-gray-800 block mb-1">Address</label>
                <input type="text"
                    name="address"
                    placeholder="e.g., 123 Freedom Way, Lagos"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 transition text-white font-medium py-3 rounded-lg">
                Complete Setup
            </button>
        </form>

    </div>
</section>

<!-- JS — Image Preview -->
<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("previewImage");
    const placeholder = document.getElementById("uploadPlaceholder");

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove("hidden");
        placeholder.classList.add("hidden");
    }
}
</script>

@endsection
