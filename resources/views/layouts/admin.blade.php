<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }" >
            @include('layouts.sidebar')
            <div class="flex flex-col flex-1 w-full">
                @include('layouts.topbar')
                <!-- Page Content -->
                <main class="h-full overflow-y-auto">
                    <div class="container px-6 mx-auto grid">
                        <!-- Pages link -->
                        {{ $pages_links ?? '' }}
                        <!-- Page Heading -->
                        @if (isset($page_title))
                            <h2 class="mt-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">  {{ $page_title }} </h2>
                        @endif

                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        @if(session()->has('message'))
            <x-popup name="confirm-user-deletion" :show="session()->has('message')" maxWidth="md" focusable>
                <div class="success p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ session('message') }}
                    </h2>
                    <div class="mt-6 flex justify-end">
                        <x-happy-button x-on:click="$dispatch('close')"  class="bg-red-600" bgColor="red">
                            {{ __('Close') }}
                        </x-happy-button>
                    </div>
                </div>
            </x-popup>
        @endif
    </body>
</html>
