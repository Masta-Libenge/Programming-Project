<!-- resources/views/student/dashboard.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>
<h1>Welcome, {{ auth()->user()->name }}</h1>
<p>You are logged in as a student.</p>

<a href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</body>
</html>

