<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* --- variabelen & basis --- */
        :root {
            --primary: #2980b9;
            --light-bg: #e6f0ff;
            --text-dark: #2c3e50;
            --white: #ffffff;
            --muted: #64748b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--light-bg);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-dark);
            padding-top: 70px;      /* ruimte voor navbar */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* --- NAVBAR --- */
        nav {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            background: var(--white);
            box-shadow: 0 4px 10px rgba(0,0,0,.05);
            padding: 1rem 2rem;
            display: flex; justify-content: space-between; align-items: center;
        }
        nav .nav-left a { font-size: 1.3rem; font-weight: 700; color: var(--primary); text-decoration: none; }
        nav .nav-right a { margin-left: 1.5rem; color: var(--muted); font-weight: 500; text-decoration: none; }
        nav .nav-right a:hover { color: var(--primary); text-decoration: underline; }

        /* --- DASHBOARD BOX --- */
        .dashboard-box {
            background: #f0f7ff;
            border-radius: 25px;
            box-shadow: 6px 6px 12px #cbdbe8, -6px -6px 12px #ffffff;
            padding: 30px 20px;
            width: 90%; max-width: 420px; text-align: center;
        }
        h1 { font-size: 1.6rem; margin-bottom: 10px; }
        p  { font-size: 1rem; color: #34495e; margin-bottom: 20px; }
        .btn {
            display: inline-block; margin: 5px;
            background: #e0f0ff; border: none; border-radius: 12px;
            padding: 12px 25px; font-weight: bold; color: var(--text-dark);
            box-shadow: 4px 4px 8px #cbdbe8, -4px -4px 8px #ffffff;
            cursor: pointer; transition: .2s ease;
        }
        .btn:hover { background: #d6e8f5; }

        /* --- MODAL --- */
        .modal{position:fixed;inset:0;display:flex;align-items:center;justify-content:center;
               background:rgba(224,240,255,.85);z-index:999;}
        .modal-content{
            position:relative;background:#f0f7ff;border-radius:20px;
            box-shadow:9px 9px 16px #cbdbe8,-9px -9px 16px #ffffff;
            padding:30px 40px;text-align:center;animation:fadeIn .4s ease;
        }
        .close-btn{position:absolute;top:10px;right:15px;font-size:20px;font-weight:bold;
                   background:none;border:none;color:#2c3e50;cursor:pointer;}
        @keyframes fadeIn{from{opacity:0;transform:scale(.95);}to{opacity:1;transform:scale(1);}}
    </style>
</head>
<body>

<!-- ✅ NAVBAR -->
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

<!-- ✅ MODAL -->
<div id="welcomeModal" class="modal">
    <div class="modal-content">
        <button class="close-btn"
                onclick="document.getElementById('welcomeModal').style.display='none'">×</button>
        <h2>Welkom, {{ Auth::user()->name }}</h2>
        <p>Je bent ingelogd als student</p>
    </div>
</div>

<!-- ✅ DASHBOARD CONTENT -->
<div class="dashboard-box">
    <h1>Welkom, {{ Auth::user()->name }}</h1>
    <p>Je bent ingelogd als student</p>

    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="btn">Uitloggen</button>
    </form>

    <a href="{{ route('student.profile.show') }}" class="btn">Bekijk je profiel</a>
</div>

</body>
</html>
