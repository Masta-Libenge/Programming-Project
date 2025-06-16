<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #2980b9;
            --light-bg: #e6f0ff;
            --text-dark: #2c3e50;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--light-bg);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .dashboard-box {
            background: #f0f7ff;
            border-radius: 25px;
            box-shadow: 6px 6px 12px #cbdbe8, -6px -6px 12px #ffffff;
            padding: 30px 20px;
            width: 90%;
            max-width: 420px;
            text-align: center;
        }

        h1 {
            font-size: 1.6rem;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            color: #34495e;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #e0f0ff;
            border: none;
            padding: 12px 25px;
            margin: 5px;
            border-radius: 12px;
            box-shadow: 4px 4px 8px #cbdbe8, -4px -4px 8px #ffffff;
            font-weight: bold;
            color: var(--text-dark);
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn:hover {
            background: #d6e8f5;
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0; left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(224, 240, 255, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .modal-content {
            position: relative;
            background: #f0f7ff;
            box-shadow: 9px 9px 16px #cbdbe8, -9px -9px 16px #ffffff;
            border-radius: 20px;
            padding: 30px 40px;
            text-align: center;
            animation: fadeIn 0.4s ease;
        }

        .modal-content h2 {
            margin: 0;
            color: var(--text-dark);
        }

        .modal-content p {
            color: #34495e;
            margin-top: 10px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            background: none;
            border: none;
            color: #2c3e50;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>

    <!-- Modal de bienvenue -->
    <div id="welcomeModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="document.getElementById('welcomeModal').style.display='none'">×</button>
            <h2>Welkom, {{ Auth::user()->name }}</h2>
            <p>Je bent ingelogd als student</p>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="dashboard-box">
        <h1>Welkom, {{ Auth::user()->name }}</h1>
        <p>Je bent ingelogd als student</p>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn">Uitloggen</button>
        </form>

        <a href="{{ route('student.profile') }}" class="btn">Bekijk je profiel</a>
    </div>

</body>
</html>
