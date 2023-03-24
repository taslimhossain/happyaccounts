<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>

            @media print {
            @page {
                size: auto;
                margin: 0.2in;
            }
                body {
                    margin: 0;
                }
            }


            /* @media print {
                header {
                    position: fixed;
                    top: 0;
                    left: 0;
                }
            } */

            

        </style>
    </head>
    <body>
        {{ $slot }}
    </body>
</html>
