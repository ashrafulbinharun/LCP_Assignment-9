<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('layouts.partials.head-scripts')
    <title> @yield('title') | {{ env('APP_NAME', 'Barta') }}</title>
</head>

<body class="h-full">
    @yield('content')
</body>

</html>
