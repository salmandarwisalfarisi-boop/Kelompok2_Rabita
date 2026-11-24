<!DOCTYPE html>
<html lang="id">

<head>
    @yield('head')
</head>

<body>
    <x-user.navbar />
    @yield('content')
    <x-user.footer />
    @yield('scripts')
</body>

</html>
