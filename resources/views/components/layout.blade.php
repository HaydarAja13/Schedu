<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css', 'resources/js/app.js')
  {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
  <link rel="shortcut icon" href="{{ asset('images/schedu-icon.svg') }}" type="image/x-icon">
  @livewireStyles
  <title>Schedu</title>
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<body class="h-full bg-[#F7F7FF]">
  {{ $slot }}
  @livewireScripts
</body>



</html>