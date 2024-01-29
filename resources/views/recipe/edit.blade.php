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
                    <input type="text" name="title" id="title" value="{{ $recipe->title }}"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $recipe->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="image"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @if ($recipe->img)
                        <img src="{{ asset($recipe->img) }}" alt="{{ $recipe->title }}" class="mt-2 rounded-md">
                    @else
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">No image uploaded</p>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded dark:bg-blue-700 dark:hover:bg-blue-900">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
