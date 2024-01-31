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
        @include('layouts.navigation1')

        <main class="items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

            {{ $slot }}

        </main>
        <!-- Footer Section -->
        <footer class="bg-gray-900 text-white py-6 text-center">
            <p>&copy; 2024 My Website. All Rights Reserved.</p>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                // Clear previous search results
                                $('#search-results').empty();
                                // Update the search results container with the new response
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
