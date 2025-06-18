<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8"> <!-- Set character encoding -->
  <title>Student Dashboard – CareerLaunch</title> <!-- Page title -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive meta -->
  <!-- Inter font from Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
    /* CSS Variables for consistent colors & radius */
    :root {
      --primary: #1E40AF; /* Main blue */
      --bg: #1E40AF;      /* Page background */
      --card-bg: #ffffff; /* Card background */
      --text: #0f172a;    /* Dark text */
      --muted: #64748b;   /* Muted text */
      --radius: 16px;     /* Border radius */
    }

    /* Reset & box model fix */
    * { box-sizing: border-box; margin: 0; padding: 0; }

    /* Page base styling */
    body {
      background-color: var(--bg); /* Blue background */
      font-family: 'Inter', sans-serif; /* Font */
      color: var(--text); /* Default text color */
    }

    /* Navbar styling */
    .navbar {
      position: sticky; /* Stick to top when scrolling */
      top: 0;
      width: 100%;
      background-color: var(--primary); /* Blue navbar */
      padding: 1rem 6%; /* Inner spacing */
      z-index: 999; /* On top of other content */
    }

    /* Navbar content container */
    .nav-container {
      display: flex; /* Flex layout */
      justify-content: space-between; /* Space between logo & links */
      align-items: center; /* Center vertically */
      max-width: 1200px; /* Limit width */
      margin: 0 auto; /* Center horizontally */
    }

    /* Logo styling */
    .logo {
      font-size: 1.4rem; /* Bigger text */
      font-weight: 800;  /* Bold */
      color: white;      /* White text */
      text-decoration: none; /* Remove underline for link */
    }

    /* Navigation links styling */
    .nav-links a {
      margin-left: 2rem; /* Space between links */
      text-decoration: none; /* No underline */
      color: white; /* White text */
      font-weight: 600; /* Bold */
      transition: color 0.3s ease; /* Smooth hover effect */
    }

    /* Hover effect for nav links */
    .nav-links a:hover {
      color: #000000; /* Change to black on hover */
    }

    /* Responsive: stack links vertically on small screens */
    @media (max-width: 768px) {
      .nav-container {
        flex-direction: column; /* Stack logo & links vertically */
        align-items: flex-start; /* Align left */
      }

      .nav-links {
        margin-top: 1rem; /* Space above links */
        display: flex;
        flex-direction: column; /* Stack links vertically */
        width: 100%;
        gap: 1rem; /* Space between links */
      }

      .nav-links a {
        margin-left: 0; /* Remove left margin on small screens */
      }
    }

    /* Dashboard wrapper styling */
    .dashboard-wrapper {
      max-width: 960px; /* Limit content width */
      margin: 4rem auto; /* Center & add top margin */
      padding: 0 1.5rem; /* Horizontal padding */
      display: flex;
      flex-direction: column;
      gap: 2rem; /* Space between sections */
      color: white; /* White text inside dashboard area */
    }

    /* Dashboard header styling */
    .dashboard-header h1 {
      font-size: 2.2rem; /* Large heading */
      font-weight: 800; /* Bold */
    }

    .dashboard-header h1 span {
      background-color: white; /* White highlight */
      color: var(--primary); /* Blue text inside highlight */
      padding: 0.2rem 0.6rem; /* Inner spacing */
      border-radius: 10px; /* Rounded highlight */
    }

    /* Card styling for sections like vacatures */
    .card {
      background-color: var(--card-bg); /* White background */
      border-radius: var(--radius); /* Rounded corners */
      padding: 2rem; /* Inner padding */
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08); /* Subtle shadow */
      color: var(--text); /* Dark text inside card */
    }

    .card h2 {
      font-size: 1.4rem; /* Card title size */
      font-weight: 700; /* Bold */
      color: var(--primary); /* Blue title */
      margin-bottom: 1rem; /* Space below title */
    }

    /* Individual vacature styling */
    .vacature {
      border-bottom: 1px solid #e2e8f0; /* Divider between vacatures */
      padding: 1rem 0; /* Vertical spacing */
    }

    .vacature:last-child {
      border-bottom: none; /* No divider for last one */
    }

    .vacature-title {
      font-weight: 700; /* Bold title */
    }

    .vacature-meta {
      color: var(--muted); /* Muted text for meta info */
      font-size: 0.9rem; /* Smaller text */
      margin-top: 0.2rem; /* Space above meta */
    }

    .no-vacatures {
      color: var(--muted); /* Muted text for empty state */
    }
  </style>
</head>
<body>

  <!-- ✅ Navbar -->
  <header class="navbar">
    <div class="nav-container">
      <!-- ✅ Logo: NOW A LINK that auto-routes to the correct dashboard -->
      @auth
        @if (auth()->user()->type === 'student')
          <a href="{{ route('student.dashboard') }}" class="logo">CareerLaunch</a>
        @elseif (auth()->user()->type === 'bedrijf')
          <a href="{{ route('bedrijf.dashboard') }}" class="logo">CareerLaunch</a>
        @else
          <a href="{{ url('/') }}" class="logo">CareerLaunch</a>
        @endif
      @else
        <a href="{{ url('/') }}" class="logo">CareerLaunch</a>
      @endauth

      <!-- ✅ Navigation links -->
      <nav class="nav-links">
        <a href="#">Planning</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('faq') }}">FAQ</a>
        <a href="#">Contact</a>
        <a href="{{ route('student.profile.show') }}">Profiel</a>
      </nav>
    </div>
  </header>

  <!-- ✅ Dashboard content -->
  <div class="dashboard-wrapper">
    <div class="dashboard-header">
      <h1>Welkom terug, <span>{{ Auth::user()->name }}</span> 👋</h1> <!-- Show logged in user's name -->
    </div>

    <div class="card">
      <h2>Nieuwste vacatures</h2>

      <!-- ✅ Show vacatures if any exist -->
      @if($vacatures->count())
        @foreach($vacatures as $vacature)
          <div class="vacature">
            <div class="vacature-title">{{ $vacature->titel }}</div> <!-- Vacature title -->
            <div class="vacature-meta">
              {{ $vacature->bedrijf->name ?? 'Onbekend bedrijf' }} – {{ $vacature->created_at->diffForHumans() }} <!-- Company name & posted time -->
            </div>
          </div>
        @endforeach
      @else
        <!-- ✅ Fallback if no vacatures -->
        <p class="no-vacatures">Er zijn momenteel geen vacatures beschikbaar.</p>
      @endif
    </div>
  </div>

</body>
</html>
