<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Welkom student</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #e0f0ff;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #e0f0ff;
            box-shadow: 9px 9px 16px #b8cbdc,
                        -9px -9px 16px #ffffff;
            border-radius: 20px;
            padding: 40px;
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            margin: 10px 5px;
            padding: 12px 25px;
            background: #e0f0ff;
            border-radius: 12px;
            box-shadow: 5px 5px 10px #b8cbdc,
                        -5px -5px 10px #ffffff;
            border: none;
            color: #2c3e50;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .btn:hover {
            box-shadow: inset 5px 5px 10px #b8cbdc,
                        inset -5px -5px 10px #ffffff;
        }

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
            background: #e0f0ff;
            box-shadow: 9px 9px 16px #b8cbdc,
                        -9px -9px 16px #ffffff;
            border-radius: 20px;
            padding: 30px 50px;
            text-align: center;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <div id="welcomeModal" class="modal">
        <div class="modal-content">
            <h1>Welkom, {{ Auth::user()->name }}</h1>
            <p>Je bent ingelogd als student</p>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn">Uitloggen</button>
        </form>
        <a href="{{ route('student.profile') }}" class="btn">Bekijk je profiel</a>
    </div>

    <script>
        window.onload = function () {
            setTimeout(() => {
                const modal = document.getElementById('welcomeModal');
                modal.style.display = 'none';
            }, 3000);
        };
    </script>
</body>
</html>
