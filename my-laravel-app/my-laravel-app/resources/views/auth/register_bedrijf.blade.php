<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren als bedrijf</title>
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
            margin-bottom: 30px;
            font-size: 2.2rem;
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            text-align: left;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #3490dc;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #2779bd;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h1>Registreren als Bedrijf</h1>
    <form method="POST" action="{{ url('/register/student') }}">
        @csrf

        <label for="name">Naam bedrijf</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Herhaal wachtwoord</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <button type="submit">Registreren</button>
    </form>
</body>
</html>
