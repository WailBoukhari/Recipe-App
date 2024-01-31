<x-guest-layout>
    <!-- Hero Section -->
    <div class="bg-gray-900 py-20 text-center text-white">
        <h1 class="text-4xl font-bold mb-4">Welcome to Our Website</h1>
        <p class="text-lg mb-8">Find what you're looking for below</p>
        <!-- Search Bar -->
        <div class="mx-auto max-w-md">
            <input type="text" id="search-input"
                class="w-full py-3 px-4 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 bg-gray-800 text-white"
                placeholder="Search...">
        </div>
    </div>
    <div id="search-results">
        <!-- Main Content Section -->
        <div class="container mx-auto mt-8">
            <h2 class="text-2xl font-bold mb-4 text-white">Featured Items</h2>
            @if (isset($recipes) && count($recipes) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($recipes as $recipe)
                        <div
                            class="bg-gray-800 rounded-lg shadow-md p-6 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="block">
                                <div class="relative overflow-hidden rounded-md">
                                    <img src="{{ $recipe->img }}" alt="{{ $recipe->title }}"
                                        class="w-full h-56 object-cover rounded-md">
                                    <!-- Overlay -->
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity opacity-0 hover:opacity-100">
                                        <p class="text-white font-semibold">View Details</p>
                                    </div>
                                </div>
                                <h2 class="text-xl font-semibold my-2 text-white">{{ $recipe->title }}</h2>
                                <p class="text-gray-300 mb-2">{{ $recipe->description }}</p>
                                <div class="flex items-center mb-2">
                                    <!-- Display Average Rating -->
                                    <p class="mr-2 text-yellow-500 font-semibold">{{ $recipe->averageRating() }}</p>
                                    <!-- Display Stars -->
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $recipe->averageRating())
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-yellow-500 fill-current mr-1"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M10 1l2.472 6.171L18 7.45l-4.109 3.529.939 5.91L10 15.25l-4.83 3.64.94-5.91L2 7.45l5.528-.28z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-gray-400 fill-current mr-1" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M10 1l2.472 6.171L18 7.45l-4.109 3.529.939 5.91L10 15.25l-4.83 3.64.94-5.91L2 7.45l5.528-.28z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <div class="flex flex-wrap mb-2">
                                    <strong class="mr-2 text-white">Categories:</strong>
                                    @foreach ($recipe->categories as $category)
                                        <span class="mr-2 mb-2 text-blue-300">{{ $category->name }}</span>
                                    @endforeach
                                </div>
                                <div class="flex flex-wrap">
                                    <strong class="mr-2 text-white">Ingredients:</strong>
                                    @foreach ($recipe->ingredients as $ingredient)
                                        <span class="mr-2 mb-2 text-blue-300">{{ $ingredient->name }}</span>
                                    @endforeach
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-gray-600">No recipes found.</p>
        @endif
    </div>

    
</x-guest-layout>
