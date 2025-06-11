<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren als student</title>

    <style>
        body {
            background: #e0f0ff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #2c3e50;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            background: #f8fbff;
            border-radius: 20px;
            box-shadow: 8px 8px 16px #c0d6e4, -8px -8px 16px #ffffff;
            text-align: center;
        }

        h2 {
            color: #004080;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 0.6rem;
            width: 80%;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            box-shadow: inset 4px 4px 8px #c0d6e4, inset -4px -4px 8px #ffffff;
        }

        button {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            box-shadow: 4px 4px 8px #bdd0e0, -4px -4px 8px #ffffff;
            cursor: pointer;
            color: #004080;
            margin-top: 15px;
            transition: background 0.3s, transform 0.2s;
        }

        button:hover {
            background: #d0e7ff;
            transform: scale(1.02);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Registratie</h2>

        <form method="POST" action="{{ route('registerStudent.submit') }}">
            @csrf

            <input type="text" name="name" placeholder="Naam" required><br>
            <input type="email" name="email" placeholder="E-mail" required><br>
            <input type="password" name="password" placeholder="Wachtwoord" required><br>
            <input type="password" name="password_confirmation" placeholder="Herhaal wachtwoord" required><br>

            <button type="submit">Registreren</button>
        </form>
    </div>
</body>
</html>
