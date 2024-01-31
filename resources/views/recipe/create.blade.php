<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Recipe') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden shadow-md">
            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data"
                class="px-6 py-8 space-y-6">
                @csrf

                <div>
                    <label for="title"
                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300">Title</label>
                    <input type="text" name="title" id="title" class="input-field">
                </div>

                <div>
                    <label for="description"
                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="4" class="input-field"></textarea>
                </div>

                <div>
                    <label for="content"
                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300">Content</label>
                    <textarea name="content" id="content" rows="4" class="input-field"></textarea>
                </div>

                <div>
                    <label for="image"
                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300">Image</label>
                    <input type="file" name="image" id="image" class="input-field">
                </div>

                <div>
                    <label for="category"
                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300">Category</label>
                    <select name="category" id="category" class="input-field">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="ingredients"
                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300">Ingredients</label>
                    <select name="ingredients[]" id="ingredients" multiple class="input-field">
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="button">Create</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
