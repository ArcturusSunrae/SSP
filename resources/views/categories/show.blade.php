<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items center">
                        <div class="w-1/2">
                            <p class="text-gray-700">Description: {{ $category->description }}</p>
                            <p class="text-gray-700">Created At: {{ $category->created_at }}</p>
                            <p class="text-gray-700">Updated At: {{ $category->updated_at }}</p>
                        </div>
                        <div class="w-1/2">
                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
