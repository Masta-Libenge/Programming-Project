<!DOCTYPE html>
<html>
<head>
    <title>Welkom bij CareerLaunch</title>
    <style>
        /* Eenvoudige stijlen voor dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
            margin: 0 10px;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 140px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: black;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        a.button {
            padding: 10px 15px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <h1>Welkom bij CareerLaunch</h1>

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

</body>
</html>
