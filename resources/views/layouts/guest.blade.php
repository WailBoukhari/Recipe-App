<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-900 antialiased">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <main
            class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

            {{ $slot }}

        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                var typingTimer; // Timer identifier
                var doneTypingInterval = 500; // Time in milliseconds (0.5 seconds)

                $('#search-input').on('keyup', function() {
                    clearTimeout(typingTimer); // Clear the previous timer

                    // Start a new timer to delay the AJAX request
                    typingTimer = setTimeout(function() {
                        var query = $('#search-input').val().trim(); // Get the value of the input field

                        // Send an AJAX request to fetch search results
                        $.ajax({
                            url: "{{ route('recipes.search') }}",
                            method: "GET",
                            data: {
                                query: query
                            },
                            success: function(response) {
                                // Update the search results container with the response
                                $('#search-results').html(response);
                            },
                            error: function(xhr, status, error) {
                                // Handle AJAX error
                                console.error('AJAX Error:', error);
                                $('#search-results').html(
                                    '<div class="alert alert-danger">An error occurred. Please try again later.</div>'
                                );
                            }
                        });
                    }, doneTypingInterval);
                });
            });
        </script>

    </body>

</html>