<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="application-name" content="APP Mercaderistas" />
        <meta name="apple-mobile-web-app-title" content="APP Mercaderistas" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="red" />
        <link rel="apple-touch-icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Arca_Continental_logo.svg/800px-Arca_Continental_logo.svg.png" />

        <!-- Primary Meta Tags -->
        <meta name="title" content="App Mercaderistas Arca" />
        <meta name="description" content="Proyecto Mercaderistas Arca Continental" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="App Mercaderistas Arca" />
        <meta property="og:description" content="Proyecto Mercaderistas Arca Continental" />
        <meta property="og:image" content="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Arca_Continental_logo.svg/800px-Arca_Continental_logo.svg.png" />

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:title" content="App Mercaderistas Arca" />
        <meta property="twitter:description" content="Proyecto Mercaderistas Arca Continental" />
        <meta property="twitter:image" content="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Arca_Continental_logo.svg/800px-Arca_Continental_logo.svg.png" />
        <meta name="description" content="Proyecto Mercaderistas Arca Continental">
        <meta name="author" content="Latech">

        <!-- Favicon -->
        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Arca_Continental_logo.svg/800px-Arca_Continental_logo.svg.png" type="image/png">


        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/2780e63ff4.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
