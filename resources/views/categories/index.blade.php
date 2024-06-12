<x-app-layout>
    <x-slot name="header">
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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mt-4">
                    <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Category</a>
                </div>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Created At</th>
                            <th class="px-4 py-2">Updated At</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="border px-4 py-2">{{ $category->id }}</td>
                                <td class="border px-4 py-2">{{ $category->title }}</td>
                                <td class="border px-4 py-2">{{ $category->description }}</td>
                                <td class="border px-4 py-2">{{ $category->created_at }}</td>
                                <td class="border px-4 py-2">{{ $category->updated_at }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('categories.show', $category->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded ">Show</a>
                                    <br>
                                    <br>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ">Edit</a>
                                    <br>
                                    <br>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Are you sure?')"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded m-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-5">
                    {{ $categories->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
