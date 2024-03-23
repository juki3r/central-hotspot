<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AJC PISONET') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style>
        #logo{
            width: 330px;
        }
        @media screen and (max-width:700px){
            #logo{
                width: 220px;
            }
        }
    </style>
    <body class="font-sans text-gray-900 antialiased ">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-color: black !important">
            <div>
                <a href="/">
                    <img src="ajclogo.png" alt="logo" id="logo">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-sm overflow-hidden sm:rounded-lg" style="background-color: gray">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
