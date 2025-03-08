<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="flex flex-col min-h-screen container mx-auto">
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')
</body>
</html>
