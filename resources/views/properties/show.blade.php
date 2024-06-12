<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $property->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex items center">
                    <div class="w-1/2">
                        <img src="{{ $property->image }}" alt="{{ $property->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="w-1/2 p-6">
                        <h2 class="text-2xl font-bold">{{ $property->name }}</h2>
                        <p class="text-lg text-gray-600">{{ $property->description }}</p>
                        <p class="text-lg text-gray-600">Price: ${{ $property->price }}</p>
                        <p class="text-lg text-gray-600">Location: {{ $property->location }}</p>
                        <p class="text-lg text-gray-600">Created: {{ $property->created_at->diffForHumans() }}</p>
                        <p class="text-lg text-gray-600">Updated: {{ $property->updated_at->diffForHumans() }}</p>
                        <a href="{{ route('properties.edit', $property) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
