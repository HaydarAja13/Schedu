<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">
    {{ $slot }}
    @livewireScripts
    
</body>
</html>
