<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentprofiel</title>
    <style>
        :root {
            --primary: #2980b9;
            --light-bg: #e6f0ff;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --badge: #3498db;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--light-bg);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            padding-top: 30px;
        }

        .wrapper {
            background: #f0f7ff;
            border-radius: 25px;
            box-shadow: 6px 6px 12px #cbdbe8, -6px -6px 12px #ffffff;
            padding: 30px 20px;
            width: 90%;
            max-width: 420px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .edit-btn {
            padding: 6px 14px;
            background: white;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            box-shadow: 2px 2px 6px #cbdbe8, -2px -2px 6px #ffffff;
            cursor: pointer;
        }

        .menu {
            font-size: 1.6rem;
            font-weight: bold;
        }

        .profile-pic {
            display: block;
            margin: 30px auto 10px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #ccc;
            box-shadow: 4px 4px 10px #cbdbe8, -4px -4px 10px #ffffff;
        }

        .username {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            font-size: 1rem;
            color: var(--text-dark);
        }

        .info-block {
            background: #e2ecf9;
            padding: 10px 16px;
            border-radius: 14px;
            margin-bottom: 10px;
            box-shadow: inset 1px 1px 3px #cbdbe8,
                        inset -1px -1px 3px #ffffff;
            color: var(--text-dark);
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .skill {
            background: var(--badge);
            color: white;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="top-bar">
            <button class="edit-btn">Bewerken</button>
            <div class="menu">☰</div>
        </div>

        <div class="profile-pic"></div>

        <div class="username">{{ Auth::user()->name ?? 'Student' }}</div>

        <div class="section-title">Persoonlijke Info</div>
        <div class="info-block">{{ Auth::user()->firstname ?? 'Omar' }} {{ Auth::user()->lastname ?? 'Ouanane' }}</div>
        <div class="info-block">{{ Auth::user()->email ?? 'student@example.com' }}</div>

        <div class="section-title">Opleiding</div>
        <div class="info-block">{{ Auth::user()->opleiding ?? 'Toegepaste Informatica' }}</div>
        <div class="info-block">Jaar {{ Auth::user()->jaar ?? '1' }}</div>

        <div class="section-title">Vaardigheden</div>
        <div class="skills-container">
            <div class="skill">HTML</div>
            <div class="skill">CSS</div>
            <div class="skill">JavaScript</div>
            <div class="skill">Ctrl+C / Ctrl+V</div>
        </div>
    </div>
</body>
</html>
