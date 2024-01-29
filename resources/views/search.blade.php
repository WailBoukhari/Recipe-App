<x-guest-layout>

        @if(isset($recipes) && count($recipes) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($recipes as $recipe)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <img src="{{ $recipe->img }}" alt="{{ $recipe->title }}" class="w-full h-40 object-cover mb-4 rounded-md">
                    <h2 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h2>
                    <p class="text-gray-600">{{ $recipe->description }}</p>
                </div>
                @endforeach
            </div>
        @else
            <p>No recipes found.</p>
        @endif

</x-guest-layout>
