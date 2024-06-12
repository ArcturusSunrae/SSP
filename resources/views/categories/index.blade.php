<x-app-layout>
    <x-slot name="header">
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
