<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon App Laravel')</title>
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="overflow-x-hidden">

    @include('components.navbar')

    <div>
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>