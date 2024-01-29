<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Recipe Details') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-2xl mx-auto">
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</p>
                <p class="mt-1 text-lg font-semibold">{{ $recipe->title }}</p>
            </div>
            
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</p>
                <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $recipe->description }}</p>
            </div>
        <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</p>
                <p class="mt-1 text-gray-700 dark:text-gray-300">{{ $recipe->content }}</p>
            </div>
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</p>
                @if ($recipe->img)
                    <img src="{{ asset($recipe->img) }}" alt="{{ $recipe->title }}" class="mt-2 rounded-md">
                @else
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">No image uploaded</p>
                @endif
            </div>

            <!-- Display Categories -->
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categories</p>
                <ul class="list-disc ml-4">
                    @foreach ($recipe->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Display Ingredients -->
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ingredients</p>
                <ul class="list-disc ml-4">
                    @foreach ($recipe->ingredients as $ingredient)
                        <li>{{ $ingredient->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
