<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
</head>
<body>
    <h1>Inloggen als Student</h1>
    <input type="hidden" name="role" value="student">
    <form method="POST" action="{{ url('/login/student') }}">
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
