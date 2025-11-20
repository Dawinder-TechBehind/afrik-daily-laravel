@extends('public.layout.main')
@section('content')
    {{-- ------------- Hero component start ------------- --}}
    <section
        class="relative flex items-center justify-center min-h-[80vh] bg-center bg-cover text-white px-5 md:px-12 rounded-2xl mt-4 md:mt-8  mx-4 md:mx-10"
        style="background-image: url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cmVhbCUyMGVzdGF0ZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=900');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40 rounded-2xl"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-3xl text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight mb-4">
                Invest in real estate, one <br class="hidden sm:block" /> share at a time.
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-gray-200 mb-6">
                Own a piece of high-yielding rental properties and earn passive income. <br />
                Democratizing real estate investing for everyone.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition">
                    Invest Now
                </button>
                <a href="/all-properties"
                    class="bg-grey-light text-gray-800 hover:bg-grey font-semibold px-6 py-3 rounded-lg shadow-lg transition">
                    Explore Properties
                </a>
            </div>
        </div>
    </section>

    {{-- ------------- Hero component end ------------- --}}
    {{-- ------------- property card component start ------------- --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 md:px-10 text-center">
            <h2 class="text-2xl font-semibold mb-8">
            Discover our latest investment opportunities.
            </h2>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://placehold.co/400x250?text=PROPERTY" alt="The Marina View" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                <h3 class="text-lg font-semibold mb-1">The Marina View</h3>
                <p class="text-gray-500 text-sm">Dubai, UAE</p>
                <p class="text-gray-500 text-sm mt-1">Projected Return: 12%</p>
                <p class="font-semibold mt-3">$100 per share</p>
                <a href="/property-details"  class="inline-block text-center mt-4 w-full bg-green-100 text-green-800 py-2 rounded-lg hover:bg-green-200 transition">
                    View Details
                </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://placehold.co/400x250?text=PROPERTY" alt="The Downtown Loft" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                <h3 class="text-lg font-semibold mb-1">The Downtown Loft</h3>
                <p class="text-gray-500 text-sm">New York, USA</p>
                <p class="text-gray-500 text-sm mt-1">Projected Return: 9%</p>
                <p class="font-semibold mt-3">$150 per share</p>
                <a href="/property-details"  class="inline-block text-center mt-4 w-full bg-green-100 text-green-800 py-2 rounded-lg hover:bg-green-200 transition">
                    View Details
                </a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://placehold.co/400x250?text=PROPERTY" alt="The Suburban Villa" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                <h3 class="text-lg font-semibold mb-1">The Suburban Villa</h3>
                <p class="text-gray-500 text-sm">London, UK</p>
                <p class="text-gray-500 text-sm mt-1">Projected Return: 8.5%</p>
                <p class="font-semibold mt-3">$120 per share</p>
                <a href="/property-details"  class="inline-block text-center mt-4 w-full bg-green-100 text-green-800 py-2 rounded-lg hover:bg-green-200 transition">
                    View Details
                </a>
                </div>
            </div>
            </div>

            <div class="mt-10">
            <a href="/all-properties" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl  transition">
                Explore More Properties
            </a>
            </div>
        </div>
    </section>
    {{-- ------------- property card component end ------------- --}}
    {{-- ------------- how it works component start ------------- --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 md:px-10">
            <h2 class="text-2xl font-semibold text-center mb-10">How It Works</h2>

            <div class="flex flex-wrap justify-center gap-8 rounded-2xl shadow-lg py-6 ">

                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center bg-white p-6 flex-1 min-w-[280px] sm:max-w-[45%] lg:max-w-[30%]">
                    <div class="bg-green-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">1. Create Your Account</h3>
                    <p class="text-gray-500 text-sm">Sign up and complete KYC verification for security and compliance.</p>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center bg-white p-6 flex-1 min-w-[280px] sm:max-w-[45%] lg:max-w-[30%]">
                    <div class="bg-green-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">2. Choose a Property</h3>
                    <p class="text-gray-500 text-sm">Browse vetted real estate opportunities with ROI, timelines, and developer info.</p>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center bg-white p-6 flex-1 min-w-[280px] sm:max-w-[45%] lg:max-w-[30%]">
                    <div class="bg-green-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">3. Buy Units</h3>
                    <p class="text-gray-500 text-sm">Select your preferred number of units and complete secure payment.</p>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col items-center text-center bg-white p-6 flex-1 min-w-[280px] sm:max-w-[45%] lg:max-w-[30%]">
                    <div class="bg-green-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">4. Own & Track Your Asset</h3>
                    <p class="text-gray-500 text-sm">Instant allocation of units. Track milestones and performance in real time.</p>
                </div>

                <!-- Step 5 -->
                <div class="flex flex-col items-center text-center bg-white p-6 flex-1 min-w-[280px] sm:max-w-[45%] lg:max-w-[30%]">
                    <div class="bg-green-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">5. Earn Rewards (Rent / Appreciation)</h3>
                    <p class="text-gray-500 text-sm">Receive rental income or benefit from property value appreciation.</p>
                </div>

                <!-- Step 6 -->
                <div class="flex flex-col items-center text-center bg-white p-6 flex-1 min-w-[280px] sm:max-w-[45%] lg:max-w-[30%]">
                    <div class="bg-green-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">6. Exit or Resell Anytime</h3>
                    <p class="text-gray-500 text-sm">Sell units via buyback or resale. Exit value adjusts to updated valuation.</p>
                </div>

            </div>
        </div>
    </section>
    {{-- ------------- how it works component end ------------- --}}
    {{-- ------------- clients component end ------------- --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 md:px-10 text-center">
            <h2 class="text-2xl font-semibold mb-10">
            See what our investors are saying
            </h2>

            <div class="grid gap-6 md:grid-cols-2">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6 text-left">
                <p class="text-gray-600 mb-6">
                “AfrikDaily has made real estate investing incredibly simple and accessible.
                I'm already seeing great returns on my first investment!”
                </p>
                <div class="flex items-center gap-4">
                <img src="https://placehold.co/50x50?text=CLIENT" alt="John Doe" class="w-12 h-12 rounded-full object-cover">
                <div>
                    <h4 class="font-semibold text-gray-800">John Doe</h4>
                    <p class="text-gray-500 text-sm">Investor</p>
                </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6 text-left">
                <p class="text-gray-600 mb-6">
                “As someone new to real estate, I was intimidated. AfrikDaily’s platform is user-friendly,
                and their team is always helpful. Highly recommend!”
                </p>
                <div class="flex items-center gap-4">
                <img src="https://placehold.co/50x50?text=CLIENT" alt="Jane Smith" class="w-12 h-12 rounded-full object-cover">
                <div>
                    <h4 class="font-semibold text-gray-800">Jane Smith</h4>
                    <p class="text-gray-500 text-sm">First-time investor</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    {{-- ------------- clients component end ------------- --}}
    {{-- ------------- footer component end ------------- --}}
    <footer class="border-t border-gray-200 py-10">
        <div class="max-w-7xl mx-auto px-4 md:px-10">
            <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-4">
            <!-- Brand Section -->
            <div>
                <h3 class="text-xl font-semibold text-green-600 mb-2">AfrikDaily</h3>
                <p class="text-gray-600 text-sm">
                Fractional real estate investing for everyone
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-gray-800 font-semibold mb-3">Quick Links</h4>
                <ul class="space-y-2 text-gray-600 text-sm">
                <li><a href="#" class="hover:text-green-600 transition">Properties</a></li>
                <li><a href="#" class="hover:text-green-600 transition">How It Works</a></li>
                <li><a href="#" class="hover:text-green-600 transition">About Us</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-gray-800 font-semibold mb-3">Support</h4>
                <ul class="space-y-2 text-gray-600 text-sm">
                <li><a href="#" class="hover:text-green-600 transition">Contact Us</a></li>
                <li><a href="#" class="hover:text-green-600 transition">FAQ</a></li>
                <li><a href="#" class="hover:text-green-600 transition">Terms of Service</a></li>
                <li><a href="#" class="hover:text-green-600 transition">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Social Links -->
            <div>
                <h4 class="text-gray-800 font-semibold mb-3">Follow Us</h4>
                <div class="flex space-x-4">
                <a href="#" class="text-gray-500 hover:text-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                        <path d="M19 0h-14C2.2 0 0 2.2 0 5v14c0 2.8 2.2 5 5 5h14c2.8 0 5-2.2 5-5V5c0-2.8-2.2-5-5-5zM7.1 20.5H3.6V9h3.5v11.5zM5.3 7.6C4.2 7.6 3.3 6.7 3.3 5.6S4.2 3.5 5.3 3.5 7.3 4.4 7.3 5.6 6.4 7.6 5.3 7.6zM20.5 20.5h-3.5v-5.5c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9v5.6h-3.5V9h3.4v1.6h.1c.5-.9 1.7-1.8 3.5-1.8 3.7 0 4.4 2.4 4.4 5.5v6.2z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-500 hover:text-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                        <path d="M19 0h-14C2.2 0 0 2.2 0 5v14c0 2.8 2.2 5 5 5h14c2.8 0 5-2.2 5-5V5c0-2.8-2.2-5-5-5zM7.1 20.5H3.6V9h3.5v11.5zM5.3 7.6C4.2 7.6 3.3 6.7 3.3 5.6S4.2 3.5 5.3 3.5 7.3 4.4 7.3 5.6 6.4 7.6 5.3 7.6zM20.5 20.5h-3.5v-5.5c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9v5.6h-3.5V9h3.4v1.6h.1c.5-.9 1.7-1.8 3.5-1.8 3.7 0 4.4 2.4 4.4 5.5v6.2z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-500 hover:text-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                        <path d="M19 0h-14C2.2 0 0 2.2 0 5v14c0 2.8 2.2 5 5 5h14c2.8 0 5-2.2 5-5V5c0-2.8-2.2-5-5-5zM7.1 20.5H3.6V9h3.5v11.5zM5.3 7.6C4.2 7.6 3.3 6.7 3.3 5.6S4.2 3.5 5.3 3.5 7.3 4.4 7.3 5.6 6.4 7.6 5.3 7.6zM20.5 20.5h-3.5v-5.5c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9v5.6h-3.5V9h3.4v1.6h.1c.5-.9 1.7-1.8 3.5-1.8 3.7 0 4.4 2.4 4.4 5.5v6.2z"/>
                    </svg>
                </a>
                </div>
            </div>
            </div>

            <!-- Bottom Section -->
            <div class="border-t border-gray-200 mt-10 pt-6 text-center text-gray-500 text-sm">
            © 2025 AfrikDaily. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- ------------- footer component end ------------- --}}

    
@endsection
