<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Welkom bij CareerLaunch</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #e0f7fa, #fff);
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 40px;
            font-size: 2.5rem;
        }

        .button-container {
            display: flex;
            gap: 20px;
        }

        .dropdown {
            position: relative;
        }

        .button {
            padding: 12px 20px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: inline-block;
        }

        .button:hover {
            background-color: #2779bd;
            transform: scale(1.05);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 110%;
            left: 0;
            background-color: #ffffff;
            min-width: 160px;
            border-radius: 6px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            text-align: left;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.2s ease;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
<h1>Welkom bij CareerLaunch</h1>

<div class="button-container">
    <div class="dropdown">
        <a href="#" class="button">Inloggen</a>
        <div class="dropdown-content">
            <a href="{{ route('login.student') }}">Student</a>
            <a href="{{ route('login.bedrijf') }}">Bedrijf</a>
        </div>
    </div>

    <div class="dropdown">
        <a href="#" class="button">Registreren</a>
        <div class="dropdown-content">
            <a href="{{ route('register.student') }}">Student</a>
            <a href="{{ route('register.bedrijf') }}">Bedrijf</a>
        </div>
    </div>
</div>
</body>
</html>
