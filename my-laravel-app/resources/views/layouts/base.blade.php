<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CareerLaunch')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1E40AF;
            --bg: #1E40AF;
            --card-bg: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --radius: 16px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: var(--bg);
            font-family: 'Inter', sans-serif;
            color: var(--text);
        }

        .navbar {
            position: sticky;
            top: 0;
            width: 100%;
            background-color: var(--primary);
            padding: 1rem 6%;
            z-index: 999;
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        .logo {
            font-size: 1.4rem;
            font-weight: 800;
            color: white;
        }
        .nav-links a {
            margin-left: 2rem;
            text-decoration: none;
            color: white;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .nav-links a:hover {
            color: #000000;
        }
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                align-items: flex-start;
            }
            .nav-links {
                margin-top: 1rem;
                display: flex;
                flex-direction: column;
                width: 100%;
                gap: 1rem;
            }
            .nav-links a {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    @yield('content')

</body>
</html>
