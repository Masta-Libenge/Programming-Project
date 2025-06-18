<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8"> <!-- Define the character encoding -->
    <title>Over Ons - CareerLaunch</title> <!-- Page title shown in browser tab -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Make page responsive -->

    <style>
        /* Define CSS variables for easy color and radius reuse */
        :root {
            --bg: #f8fafc; /* Light background color */
            --white: #ffffff; /* Pure white */
            --accent: #1e3a8a; /* Main accent color (dark blue) */
            --muted: #64748b; /* Muted text color (greyish blue) */
            --radius: 16px; /* Standard border radius for rounded corners */
        }

        /* Base body styling */
        body {
            margin: 0; /* Remove default margin */
            font-family: 'Segoe UI', sans-serif; /* Set font */
            background-color: var(--bg); /* Use light background */
            color: var(--accent); /* Default text color */
            padding-top: 80px; /* Space for the fixed navbar */
        }

        /* Navbar styling */
        nav {
            background-color: var(--white); /* White background for navbar */
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); /* Light shadow under navbar */
            padding: 1rem 2rem; /* Space inside navbar */
            position: fixed; /* Fix navbar at top */
            top: 0; /* Stick to top */
            width: 100%; /* Full width */
            z-index: 1000; /* Ensure it stays on top of other elements */
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Space between left and right nav parts */
            align-items: center; /* Vertically center items */
        }

        /* Left side of navbar (logo) */
        nav .nav-left a {
            font-size: 1.3rem; /* Logo font size */
            font-weight: 700; /* Bold logo text */
            color: var(--accent); /* Logo color */
            text-decoration: none; /* Remove underline */
        }

        /* Right side of navbar (links) */
        nav .nav-right a {
            margin-left: 1.5rem; /* Space between links */
            color: var(--muted); /* Muted link color */
            text-decoration: none; /* No underline */
            font-weight: 500; /* Medium weight */
            font-size: 1rem; /* Normal font size */
        }

        /* Hover effect for navbar links */
        nav .nav-right a:hover {
            color: var(--accent); /* Darker color on hover */
            text-decoration: underline; /* Add underline on hover */
        }

        /* Container for page content */
        .container {
            max-width: 1000px; /* Limit content width */
            margin: 2rem auto; /* Center container with vertical spacing */
            padding: 0 1.5rem; /* Horizontal padding inside container */
        }

        /* Main heading style */
        h1 {
            font-size: 2.5rem; /* Large heading */
            margin-bottom: 1rem; /* Space below heading */
        }

        /* Paragraph style */
        p {
            font-size: 1.1rem; /* Slightly larger paragraph text */
            line-height: 1.7; /* Comfortable line spacing */
            color: var(--muted); /* Use muted text color for paragraphs */
        }

        /* Container for feature cards */
        .features {
            display: flex; /* Flex layout for responsive grid */
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            gap: 1.5rem; /* Gap between feature cards */
            margin-top: 3rem; /* Space above features section */
        }

        /* Individual feature card style */
        .feature {
            flex: 1 1 280px; /* Flex-grow, flex-shrink, base width */
            background: var(--white); /* White background for card */
            border-radius: var(--radius); /* Rounded corners */
            padding: 1.5rem; /* Space inside card */
            box-shadow: 0 8px 20px rgba(0,0,0,0.04); /* Subtle shadow */
        }

        /* Feature card heading style */
        .feature h3 {
            margin-bottom: 0.5rem; /* Space below heading */
            color: var(--accent); /* Accent color */
        }

        /* Feature card paragraph style */
        .feature p {
            font-size: 0.95rem; /* Slightly smaller than regular p */
        }

        /* ✅ Back button styling (same as other pages) */
        .back-button {
            display: inline-block; /* Make it a block-level link */
            margin: 1rem 1.5rem; /* Space around the button */
            color: var(--accent); /* Text color */
            font-size: 0.95rem; /* Font size */
            text-decoration: none; /* Remove underline */
            border: 1px solid var(--accent); /* Outline with accent color */
            padding: 0.5rem 1rem; /* Space inside the button */
            border-radius: 18px; /* Rounded corners (matches register page) */
            transition: background-color 0.2s ease, color 0.2s ease; /* Smooth hover transitions */
        }

        /* Back button hover effect */
        .back-button:hover {
            background-color: var(--accent); /* Fill with accent color */
            color: white; /* Switch text to white */
        }
    </style>
</head>
<body>

<!-- ✅ NAVBAR with dynamic logo -->
<nav>
    <!-- ✅ Left side: Dynamic logo link -->
    <div class="nav-left">
        @auth
            @if (auth()->user()->type === 'student')
                <a href="{{ route('student.dashboard') }}">CareerLaunch</a> <!-- If student, go to student dashboard -->
            @elseif (auth()->user()->type === 'bedrijf')
                <a href="{{ route('bedrijf.dashboard') }}">CareerLaunch</a> <!-- If bedrijf, go to bedrijf dashboard -->
            @else
                <a href="{{ url('/') }}">CareerLaunch</a> <!-- Fallback for other types -->
            @endif
        @else
            <a href="{{ url('/') }}">CareerLaunch</a> <!-- If not logged in, link to home -->
        @endauth
    </div>

    <!-- ✅ Right side: Navigation links -->
    <div class="nav-right">
        <a href="#">Planning</a> <!-- Example link -->
        <a href="{{ route('about') }}">About&nbsp;Us</a> <!-- About link -->
        <a href="{{ route('faq') }}">FAQ</a> <!-- FAQ link -->
        <a href="#">Contact</a> <!-- Contact link -->
    </div>
</nav>

<!-- ✅ BACK BUTTON (same style & placement as in register page) -->
<a href="{{ url('/') }}" class="back-button">← Terug</a> <!-- Back button to homepage -->

<!-- ✅ PAGE CONTENT -->
<div class="container">
    <h1>Over CareerLaunch</h1> <!-- Page heading -->
    <p>
        CareerLaunch is een platform dat studenten en bedrijven met elkaar verbindt op een innovatieve en toegankelijke manier.
        Via stages, vacatures en directe communicatie helpen we jong talent om hun professionele pad te vinden.
    </p>

    <!-- ✅ Features section with 3 feature cards -->
    <div class="features">
        <div class="feature">
            <h3>🎯 Missie</h3> <!-- Feature title -->
            <p>Onze missie is om drempels tussen onderwijs en arbeidsmarkt te verlagen door slimme tools, transparantie en gebruiksvriendelijke matching.</p> <!-- Feature description -->
        </div>
        <div class="feature">
            <h3>🤝 Visie</h3> <!-- Feature title -->
            <p>We willen een digitale brug zijn tussen studenten, scholen en bedrijven, en zo bijdragen aan duurzame loopbanen en talentontwikkeling.</p> <!-- Feature description -->
        </div>
        <div class="feature">
            <h3>🔒 Betrouwbaarheid</h3> <!-- Feature title -->
            <p>Alle gegevens worden veilig beheerd en elk profiel wordt zorgvuldig gecontroleerd op echtheid en relevantie.</p> <!-- Feature description -->
        </div>
    </div>
</div>

</body>
</html>
