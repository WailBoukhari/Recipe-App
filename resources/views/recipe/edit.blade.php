<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Recipe') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $recipe->title) }}"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $recipe->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                    <textarea name="content" id="content" rows="4"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('content', $recipe->content) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @if ($recipe->img)
                        <img src="{{ asset($recipe->img) }}" alt="{{ $recipe->title }}" class="mt-2 rounded-md">
                    @else
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">No image uploaded</p>
                    @endif
                </div>

            <div class="mb-4">
    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
    <select name="category" id="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <!-- Populate categories options dynamically -->
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

                <div class="mb-4">
                    <label for="ingredients" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ingredients</label>
                    <select name="ingredients[]" id="ingredients" multiple class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <!-- Populate ingredients options dynamically -->
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}" {{ in_array($ingredient->id, $recipe->ingredients->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded dark:bg-blue-700 dark:hover:bg-blue-900">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
