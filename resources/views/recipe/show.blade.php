<x-guest-layout>
    <div class="container mx-auto py-8">
        <div class="bg-gray-900 rounded-lg shadow-lg p-6">
            <img src="{{ asset($recipe->img) }}" alt="{{ $recipe->title }}"
                class="w-1/2 h-64 object-cover mb-6 rounded-md shadow-lg">

            <h2 class="text-4xl font-semibold mb-4 text-white">{{ $recipe->title }}</h2>
            <p class="text-gray-400 mb-6">{{ $recipe->description }}</p>

            <div class="mb-6">
                <h3 class="text-2xl font-semibold mb-2 text-white">Categories:</h3>
                <ul class="list-disc ml-4 text-gray-300">
                    @foreach ($recipe->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="text-2xl font-semibold mb-2 text-white">Ingredients:</h3>
                <ul class="list-disc ml-4 text-gray-300">
                    @foreach ($recipe->ingredients as $ingredient)
                        <li>{{ $ingredient->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="text-2xl font-semibold mb-2 text-white">Content:</h3>
                <p class="text-gray-300">{{ $recipe->content }}</p>
            </div>

            <!-- Rating Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-white">Rating</h2>
                <div class="flex items-center mb-4">
                    <!-- Display Average Rating -->
                    <p class="mr-4 text-yellow-400">Average Rating: {{ $recipe->averageRating() }}</p>
                    <!-- Display Stars -->
                    <div class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $recipe->averageRating())
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-yellow-400 fill-current mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10 1l2.472 6.171L18 7.45l-4.109 3.529.939 5.91L10 15.25l-4.83 3.64.94-5.91L2 7.45l5.528-.28z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400 fill-current mr-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M10 1l2.472 6.171L18 7.45l-4.109 3.529.939 5.91L10 15.25l-4.83 3.64.94-5.91L2 7.45l5.528-.28z" />
                                </svg>
                            @endif
                        @endfor
                    </div>
                </div>
                <!-- Rating Form -->
                <form action="{{ route('recipes.rate', $recipe) }}" method="POST" class="flex items-center">
                    @csrf
                    <!-- Rating Input -->
                    <select name="rating" id="rating"
                        class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none appearance-none bg-gray-800 text-gray-300 mr-4">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <!-- Submit Button -->
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                        Rate
                    </button>
                </form>
            </div>

            <!-- Comment Section -->
            <div>
                <h2 class="text-2xl font-semibold mb-4 text-white">Comments</h2>
                <!-- Comment Form -->
                <form action="{{ route('recipes.comment', $recipe) }}" method="POST" class="mb-4">
                    @csrf
                    <!-- Comment Input -->
                    <textarea name="content" id="content" rows="3"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 mb-2 focus:outline-none focus:border-blue-500 bg-gray-800 text-gray-300"
                        placeholder="Leave your comment..."></textarea>
                    <!-- Submit Button -->
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                        Comment
                    </button>
                </form>
                <!-- Display Comments -->
                @foreach ($recipe->comments as $comment)
                    <div class="bg-gray-800 p-4 rounded-md mb-4">
                        <p class="text-gray-300">{{ $comment->content }}</p>
                        @if ($comment->user)
                            <p class="text-sm text-gray-400">Posted by {{ $comment->user->name }} on
                                {{ $comment->created_at->format('M d, Y') }}</p>
                        @else
                            <p class="text-sm text-gray-400">Posted by Unknown User on
                                {{ $comment->created_at->format('M d, Y') }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
