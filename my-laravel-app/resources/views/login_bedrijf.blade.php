<!DOCTYPE html>
<html>
<head>
    <title>Bedrijf Login</title>
</head>
<body>
    <h1>Inloggen als Bedrijf</h1>
    <form method="POST" action="{{ url('/login/bedrijf') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Wachtwoord:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Inloggen</button>
    </form>
</body>
</html>
