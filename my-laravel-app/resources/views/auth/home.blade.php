<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>CareerLaunch – Start je toekomst</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --black: #0f172a;
            --blue: #2563eb;
            --bg: #f8fafc;
            --text-muted: #64748b;
            --radius: 20px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg);
            color: var(--black);
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
            padding: 2rem;
        }

        .left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
        }

        .left h1 {
            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 1.2rem;
            line-height: 1.2;
        }

        .left p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            max-width: 480px;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .cta-buttons a {
            padding: 0.85rem 1.6rem;
            border-radius: var(--radius);
            background-color: var(--blue);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .cta-buttons a:hover {
            background-color: #1e40af;
            transform: translateY(-2px);
        }

        .right {
            background: url('https://images.unsplash.com/photo-1531496651418-9f9c0b3e53aa?auto=format&fit=crop&w=1050&q=80') center/cover no-repeat;
            border-radius: var(--radius);
        }

.right {
    background: url('/launch.png') center/cover no-repeat;
    border-radius: var(--radius);
}

        @media (max-width: 900px) {
            .grid-container {
                grid-template-columns: 1fr;
                padding: 1.5rem;
            }

            .right {
                height: 220px;
                border-radius: var(--radius);
                margin-bottom: 2rem;
            }

            .left {
                text-align: center;
                padding: 1rem;
            }

            .cta-buttons {
                justify-content: center;
            }

            .left h1 {
                font-size: 2.4rem;
            }


}

        
    </style>
</head>
<body>

    <div class="grid-container">
        <div class="left">
            <h1>Start je carrière<br> met één klik</h1>
            <p>Kies je rol en vind meteen relevante matches. CareerLaunch brengt bedrijven en studenten dichter bij elkaar.</p>
            <div class="cta-buttons">
                <a href="{{ route('login.student') }}">Ik ben student</a>
                <a href="{{ route('login.bedrijf') }}">Ik ben bedrijf</a>
            </div>
        </div>
        <div class="right"></div>
    </div>

</body>
</html>
