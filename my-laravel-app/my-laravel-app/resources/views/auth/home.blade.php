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
            justify-content: center;
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
        }

        .button:hover {
            background-color: #2779bd;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<h1>Welkom bij CareerLaunch</h1>

<div class="button-container">
    <a href="{{ route('login.student') }}" class="button">Student</a>
    <a href="{{ route('login.bedrijf') }}" class="button">Bedrijf</a>
</div>

</body>
</html>
