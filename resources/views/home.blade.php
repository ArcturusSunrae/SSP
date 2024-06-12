<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RentWise</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>


    <body class="bg-purple-100 text-gray-800">
    <!-- Header -->
    <header class="bg-purple-900 text-white p-4 mb-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
                <div class="text-2xl font-bold">RentWise</div>

            </div>


            <nav>
                <ul class="flex space-x-4">
                    <li><a href="/" class="hover:underline">Home</a></li>
                    <li><a href="/properties" class="hover:underline">Listings</a></li>
                    <li><a href="/categories" class="hover:underline">Categories</a></li>
                    <li><a href="#" class="hover:underline">Services</a></li>
                    <li><a href="#" class="hover:underline">Blogs</a></li>
                </ul>
            </nav>
            <div class="flex space-x-4">
                <a href="/register" class="px-4 py-2 bg-white text-purple-900 font-bold rounded-lg border border-purple-900 hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">Register</a>
                <a href="/login" class="px-4 py-2 bg-white text-purple-900 font-bold rounded-lg border border-purple-900 hover:bg-purple-900 hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">Login</a>
                <a href="#" class="bg-white text-purple-900 py-2 px-4 rounded-lg">Add Listing</a>
            </div>

            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Teams Dropdown -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-dropdown-link>
                                        @endcan

                                        <!-- Team Switcher -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        @endif
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif

                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                             src="{{ Auth::user()->getFirstMediaUrl('profile_photo') }}"
                                             alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            @endauth
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-purple-200 py-16 mb-8 px-4 md:px-8 lg:px-12">
                <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/2 space-y-4 mb-8 md:mb-0">
                        <h1 class="text-4xl font-bold">Find a perfect home you love..!</h1>
                        <p class="text-lg">Discover the perfect home that captures your heart and suits your lifestyle. Whether it's a cozy bungalow, modern apartment, or spacious family house, our listings and expert guidance help you find a place you'll love. Explore neighborhoods, compare features, and envision your future in a home that meets all your needs. Start your journey today and find your perfect space.</p>
                        <div class="mt-8 flex space-x-2">
                            <img src="Images/happy-user.jpg" alt="Happy Customers" class="w-10 h-10 rounded-full">
                            <span>2k+ Happy Customers</span>
                        </div>
                        <div class="mt-2 flex space-x-2">
                            <img src="images/new-house" alt="New Listings" class="w-10 h-10 rounded-full">
                            <span>200+ New Listings Everyday!</span>
                        </div>
                    </div>
                    <div class="md:w-1/2 mt-8 md:mt-0">
                        <img src="images/modern-living-rooms.jpg" alt="Living Room" class="rounded-lg shadow-lg">
                    </div>
                </div>
            </section>

            <!-- Services -->
            <section class="container mx-auto py-16 mb-8 px-4 md:px-8 lg:px-12">
                <div class="text-center">
                    <h2 class="text-3xl font-bold mb-8">Who Are We</h2>
                    <p class="text-lg mb-12">Assisting individuals in finding their dream home</p>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold mb-4">Renting Home</h3>
                            <p>Renting a home offers flexibility and convenience, whether you're looking for a temporary residence or a long-term solution. With a wide range of options from cozy apartments to spacious houses, you can find a rental that fits your lifestyle and budget. Enjoy the benefits of a ready-to-live-in space without the commitment of ownership. Explore our listings today to find your next home sweet home.</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold mb-4">Property Services</h3>
                            <p>Our property management services offer comprehensive solutions to ensure your real estate investments are well-maintained and profitable. From tenant screening and rent collection to maintenance and legal compliance, we handle every aspect of property management with professionalism and efficiency. Trust us to maximize your property's value while providing exceptional service to both owners and tenants.</p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold mb-4">Rent an Appartment</h3>
                            <p>Renting an apartment has never been easier. Explore a wide range of options that fit your lifestyle and budget, from cozy studios to spacious multi-bedroom units. With our user-friendly search tools and expert support, finding the perfect rental is a breeze. Start your journey today and move into a place you’ll love calling home.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Latest Listed Properties -->
            <section class="bg-purple-200 py-16 mb-8 px-4 md:px-8 lg:px-12">
                <div class="container mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-8">Latest Listed Properties</h2>
                    <div class="flex justify-center space-x-4 mb-12">
                        <button class="py-2 px-4 bg-white text-purple-900 rounded-full">All</button>
                        <button class="py-2 px-4 bg-white text-purple-900 rounded-full">Rent</button>
                        <button class="py-2 px-4 bg-white text-purple-900 rounded-full">Services</button>
                    </div>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Repeat this block for each property -->
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <img src="images/property-1.jpg" alt="Property" class="w-full h-40 object-cover rounded-lg mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-lg font-bold">120,000/=(LKR)</span>
                                <span class="bg-red-500 text-white py-1 px-3 rounded-full">Popular</span>
                            </div>
                            <p class="text-sm text-gray-600">719 Gerda Terrace Apt. 824
                                Willmschester, VA 20636</p>
                            <p class="text-sm text-black-600">2 bed, 2 bath</p>
                        </div>
                        <!-- End property block -->

                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <img src="images/property-2.jpeg" alt="Property" class="w-full h-40 object-cover rounded-lg mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-lg font-bold">70,000/= (LKR)</span>
                                <span class="bg-red-500 text-white py-1 px-3 rounded-full">Popular</span>
                            </div>
                            <p class="text-sm text-gray-600">8895 Dorris Prairie Suite 061
                                Lefflerview, MO 81729</p>
                            <p class="text-sm text-black-600">4 bedroom, 3 bath</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <img src="images/property-3.webp" alt="Property" class="w-full h-40 object-cover rounded-lg mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-lg font-bold">210,000</span>
                                <span class="bg-red-500 text-white py-1 px-3 rounded-full">Popular</span>
                            </div>
                            <p class="text-sm text-gray-600">96383 Murray Via
                                    Antonetteburgh, ME 77339</p>
                            <p class="text-sm text-black-600">5 bedrooms, 3 bath</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Neighborhood Properties -->
            <section class="container mx-auto py-16 mb-8 px-4 md:px-8 lg:px-12">
                <h2 class="text-3xl font-bold mb-8 text-center">Neighborhood Properties</h2>
                <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
                    <!-- Repeat this block for each neighborhood property -->
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <img src="images/near-1.jpeg" alt="Neighborhood" class="w-full h-40 object-cover rounded-lg mb-4">
                        <p class="text-sm text-gray-600">30 Listings</p>
                        <p class="text-lg font-bold">Minuwangoda, 11550</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <img src="images/near-2.jpg" alt="Neighborhood" class="w-full h-40 object-cover rounded-lg mb-4">
                        <p class="text-sm text-gray-600">45 Listings</p>
                        <p class="text-lg font-bold">Nuwara, 22200</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <img src="images/near-3.jpeg" alt="Neighborhood" class="w-full h-40 object-cover rounded-lg mb-4">
                        <p class="text-sm text-gray-600">56 Listings</p>
                        <p class="text-lg font-bold">Galle, 80000</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <img src="images/near-4.jpg" alt="Neighborhood" class="w-full h-40 object-cover rounded-lg mb-4">
                        <p class="text-sm text-gray-600">20 Listings</p>
                        <p class="text-lg font-bold">Negombo, 11410</p>
                    </div>
                    <!-- End neighborhood property block -->
                </div>
            </section>

            <!-- Team Members -->
            <section class="bg-purple-200 py-16 mb-8 px-4 md:px-8 lg:px-12">
                <div class="container mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-8">Our Team of Experts</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Repeat this block for each team member -->
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <img src="images/expert-2.avif" alt="New Listings" class="w-26 h-30 rounded-full ">
                            <h3 class="text-xl font-bold">Andrea Santiago</h3>
                            <p class="text-sm text-gray-600">CEO & Founder</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <img src="images/person-1.jpg" alt="New Listings" class="w-25 h-30 rounded-full  ">
                            <h3 class="text-xl font-bold">Rohith Agesh</h3>
                            <p class="text-sm text-gray-600">Marketing head</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <img src="images/How-to-Stand-Out-with-your-LinkedIn-Headshot.jpg" alt="New Listings" class="w-25 h-25 rounded-full  ">
                            <br>
                            <br>
                            <h3 class="text-xl font-bold">Xiao Wu</h3>
                            <p class="text-sm text-gray-600">Developper</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <img src="images/expert-4.jpeg" alt="New Listings" class="w-25 h-30 rounded-full  ">
                            <h3 class="text-xl font-bold">Sandra Lee</h3>
                            <p class="text-sm text-gray-600">Human Resource Head</p>
                        </div>
                        <!-- End team member block -->
                    </div>
                </div>
            </section>

            <!-- Testimonials -->
            <section class="container mx-auto py-16 mb-8 px-4 md:px-8 lg:px-12">
                <h2 class="text-3xl font-bold mb-8 text-center">Look What Our Customers Say!</h2>
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl mx-auto">
                    <p class="text-lg italic mb-4">"I highly recommend Judi and Appleby..."</p>
                    <p class="text-sm text-gray-600 mb-2">- Barbara D. Smith</p>
                </div>
            </section>

        </div>
    </div>
    <!-- Footer -->

    <footer class="bg-purple-900 text-white py-8 mt-8 px-4 md:px-8 lg:px-12">
        <div class="container mx-auto flex flex-wrap justify-between items-center">
            <div class="mb-8 md:mb-0">
                <h3 class="text-xl font-bold">RentWise</h3>
                <p>4631, Ilorin...</p>
                <p>support@rentwise.com</p>
            </div>
            <div class="mb-8 md:mb-0">
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul>
                    <li><a href="/home" class="hover:underline">Home</a></li>
                    <li><a href="/properties" class="hover:underline">Listings</a></li>
                    <li><a href="#" class="hover:underline">Services</a></li>
                    <li><a href="#" class="hover:underline">Blogs</a></li>
                </ul>
            </div>
            <div class="mb-8 md:mb-0">
                <h4 class="font-bold mb-4">Subscribe to our newsletter!</h4>
                <form action="#">
                    <input type="email" class="py-2 px-4 rounded-lg mb-4" placeholder="Enter your email">
                    <button type="submit" class="bg-white text-purple-900 py-2 px-4 rounded-lg">Subscribe</button>
                </form>
            </div>
            <div>
                <h4 class="font-bold mb-4">Follow us on</h4>
                <div class="flex space-x-4">
                    <a href="#"><img src="images/fb.png" alt="Facebook" class="w-8 h-8"></a>
                    <a href="#"><img src="images/x.png" alt="Twitter" class="w-8 h-8"></a>
                    <a href="#"><img src="images/ig.jpeg" alt="Instagram" class="w-8 h-8"></a>
                </div>
            </div>
        </div>
    </footer>

    </body>
    </html>
</x-app-layout>
