@if (isset($recipes) && count($recipes) > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($recipes as $recipe)
            <div class="bg-white rounded-lg shadow-md p-6">
                <a href="{{ route('recipes.show', $recipe->id) }}">

                    <img src="{{ $recipe->img }}" alt="{{ $recipe->title }}"
                        class="w-full h-40 object-cover mb-4 rounded-md">
                    <h2 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h2>
                    <p class="text-gray-600">{{ $recipe->description }}</p>
                    <p><strong>Categories:</strong>
                        @foreach ($recipe->categories as $category)
                            {{ $category->name }}
                        @endforeach
                    </p>
                    <p><strong>Ingredients:</strong>
                        @foreach ($recipe->ingredients as $ingredient)
                            {{ $ingredient->name }},
                        @endforeach
                    </p>
                </a>
            </div>
        @endforeach
    </div>
@else
    <p>No recipes found.</p>
@endif
