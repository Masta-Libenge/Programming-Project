<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren als bedrijf</title>
    <style>
        /* Zelfde CSS als hierboven */
    </style>
</head>
<body>
    <h1>Registreren als bedrijf</h1>
    <form method="POST" action="{{ url('/register/bedrijf') }}">
        @csrf

        <label for="company_name">Bedrijfsnaam</label>
        <input type="text" name="company_name" id="company_name" required>

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
