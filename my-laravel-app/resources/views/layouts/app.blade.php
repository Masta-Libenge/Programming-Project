<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CareerLaunch')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #1E40AF;
            --light-bg: #1E40AF;
            --text-dark: #ffffff;
            --white: #1E40AF;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--light-bg);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-dark);
            padding-top: 70px;
            min-height: 100vh;
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: var(--white);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .nav-left a {
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        nav .nav-right a {
            margin-left: 1.5rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav .nav-right a:hover {
            color: black;
        }

        .modal {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1E40AF;
            backdrop-filter: blur(6px);
            z-index: 999;
        }

        .modal-content {
            background: #f0f7ff;
            border-radius: 20px;
            padding: 30px 40px;
            text-align: center;
        }

        .modal-content h2 {
            margin-bottom: 10px;
        }

        .modal-content p {
            color: #34495e;
            margin-bottom: 20px;
        }

        .close-btn-bottom {
            margin-top: 20px;
            background: #1E40AF;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn-bottom:hover {
            background: #153e9e;
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-left">
        <a href="{{ route('student.dashboard') }}">CareerLaunch</a>
    </div>
    <div class="nav-right">
        <a href="#">Planning</a>
        <a href="#">About&nbsp;Us</a>
        <a href="#">FAQ</a>
        <a href="#">Contact</a>
        <a href="{{ route('student.profile.show') }}">Profiel</a>
    </div>
</nav>

@yield('content')

</body>
</html>
