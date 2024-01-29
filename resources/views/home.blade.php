<x-guest-layout>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Recipes</h1>
            <input type="text" id="search-input" placeholder="Search"
                class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
        </div>
        <div id="search-results">

            @if (isset($recipes) && count($recipes) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($recipes as $recipe)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <img src="{{ $recipe->img }}" alt="{{ $recipe->title }}"
                                class="w-full h-40 object-cover mb-4 rounded-md">
                            <h2 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h2>
                            <p class="text-gray-600">{{ $recipe->description }}</p>
        <p><strong>Categories:</strong> 
            @foreach($recipe->categories as $category)
                {{ $category->name }}
            @endforeach
        </p>                            <p><strong>Ingredients:</strong>
                                @foreach ($recipe->ingredients as $ingredient)
                                    {{ $ingredient->name }},
                                @endforeach
                            </p>dforeach
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No recipes found.</p>
            @endif
        </div>
    </div>
</x-guest-layout>
