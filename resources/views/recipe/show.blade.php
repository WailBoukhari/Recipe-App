<x-guest-layout>
    <div class="container mx-auto py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <img src="{{ asset($recipe->img) }}" alt="{{ $recipe->title }}"
                class="w-full h-40 object-cover mb-4 rounded-md">
            <h2 class="text-3xl font-semibold mb-2">{{ $recipe->title }}</h2>
            <p class="text-gray-600 mb-4">{{ $recipe->description }}</p>

            <div>
                <h3 class="text-xl font-semibold mb-2">Categories:</h3>
                <ul>
                    @foreach ($recipe->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-2">Ingredients:</h3>
                <ul>
                    @foreach ($recipe->ingredients as $ingredient)
                        <li>{{ $ingredient->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-2">Content:</h3>
                <p>{{ $recipe->content }}</p>
            </div>
            <!-- Rating Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Rating</h2>
                <div class="flex items-center">
                    <!-- Display Average Rating -->
                    <p class="mr-4">Average Rating: {{ $recipe->averageRating() }}</p>
                    <!-- Display Stars -->
                    <div class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $recipe->averageRating())
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-yellow-500 fill-current mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10 1l2.472 6.171L18 7.45l-4.109 3.529.939 5.91L10 15.25l-4.83 3.64.94-5.91L2 7.45l5.528-.28z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 fill-current mr-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M10 1l2.472 6.171L18 7.45l-4.109 3.529.939 5.91L10 15.25l-4.83 3.64.94-5.91L2 7.45l5.528-.28z" />
                                </svg>
                            @endif
                        @endfor
                    </div>
                </div>
                <!-- Rating Form -->
                <form action="{{ route('recipes.rate', $recipe) }}" method="POST" class="mt-2">
                    @csrf
                    <!-- Rating Input -->
                    <select name="rating" id="rating"
                        class="border border-gray-300 rounded-md px-2 py-1 focus:outline-none appearance-none">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <!-- Submit Button -->
                    <button type="submit" class="ml-2 px-4 py-1 bg-blue-500 text-white rounded-md">Rate</button>
                </form>
            </div>

            <!-- Comment Section -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Comments</h2>
                <!-- Comment Form -->
                <form action="{{ route('recipes.comment', $recipe) }}" method="POST" class="mb-4">
                    @csrf
                    <!-- Comment Input -->
                    <textarea name="content" id="content" rows="3" class="w-full border border-gray-300 rounded-md px-2 py-1"></textarea>
                    <!-- Submit Button -->
                    <button type="submit" class="mt-2 px-4 py-1 bg-blue-500 text-white rounded-md">Comment</button>
                </form>
                <!-- Display Comments -->
                @foreach ($recipe->comments as $comment)
                    <div class="bg-gray-100 p-4 rounded-md mb-2">
                        <p>{{ $comment->content }}</p>
                        @if ($comment->user)
                            <p class="text-sm text-gray-500">Posted by {{ $comment->user->name }} on
                                {{ $comment->created_at->format('M d, Y') }}</p>
                        @else
                            <p class="text-sm text-gray-500">Posted by Unknown User on
                                {{ $comment->created_at->format('M d, Y') }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
