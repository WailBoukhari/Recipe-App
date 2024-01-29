<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Recipe') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="overflow-x-auto">
            <a href="{{ route('recipes.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded dark:bg-blue-700 dark:hover:bg-blue-900">Add
                Recipe</a>

            <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-700 text-white">
                <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Title</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Description</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Image</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Categories</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Ingredients</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recipes as $recipe)
                        <tr>
                            <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $recipe->title }}</td>
                            <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $recipe->description }}</td>
                            <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                @if ($recipe->img)
                                    <img src="{{ asset($recipe->img) }}" alt="{{ $recipe->title }}"
                                        class="w-full h-40 object-cover mb-4 rounded-md">
                                @else
                                    <!-- Show placeholder image or text if no image is uploaded -->
                                @endif
                            </td>
                            <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                @foreach ($recipe->categories as $category)
                                    {{ $category->name }}
                                @endforeach
                            </td>
                            <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                @foreach ($recipe->ingredients as $ingredient)
                                    {{ $ingredient->name }},
                                @endforeach
                            </td>
                            <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                <a href="{{ route('recipes.edit', $recipe->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded dark:bg-yellow-700 dark:hover:bg-yellow-900">Edit</a>
                                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded dark:bg-red-700 dark:hover:bg-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
