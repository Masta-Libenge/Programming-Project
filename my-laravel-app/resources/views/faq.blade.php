<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8"> <!-- Character encoding -->
  <title>FAQ – CareerLaunch</title> <!-- Page title -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Make responsive -->
  <!-- Google font for Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  
  <style>
    /* ✅ CSS variables for colors & radius */
    :root {
      --bg-blue: #1E40AF; /* Dark blue background */
      --white: #ffffff;   /* White color */
      --text: #0f172a;    /* Dark text color */
      --muted: #64748b;   /* Muted grey color */
      --green: #065f46;   /* Green text */
      --green-bg: #d1fae5; /* Light green background */
      --radius: 12px;     /* Rounded corners */
    }

    /* ✅ Reset margins & box sizing */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* ✅ Body base styling */
    body {
      font-family: 'Inter', sans-serif; /* Inter font */
      background-color: var(--bg-blue); /* Dark blue bg */
      color: var(--white);               /* White text by default */
      min-height: 100vh;                 /* Full height */
      padding-top: 80px;                 /* Leave space for fixed nav */
    }

    /* ✅ Navbar styling */
    nav {
      background: var(--bg-blue); /* Dark blue navbar */
      position: fixed;            /* Stick to top */
      top: 0; left: 0; right: 0;  /* Stretch full width */
      z-index: 1000;              /* Stay on top */
      display: flex;              /* Flex layout */
      justify-content: space-between; /* Space between logo & links */
      align-items: center;        /* Center items vertically */
      padding: 1rem 6%;           /* Inner spacing */
      box-shadow: 0 4px 10px rgba(0,0,0,0.1); /* Subtle shadow */
    }

    /* ✅ Logo styling inside nav */
    nav .logo {
      font-size: 1.4rem;    /* Bigger logo text */
      font-weight: 800;     /* Bold */
      color: var(--white);  /* White text */
      text-decoration: none; /* Remove underline for logo link */
    }

    /* ✅ Nav links styling */
    nav .nav-links a {
      margin-left: 2rem;    /* Space between links */
      color: var(--white);  /* White text */
      text-decoration: none; /* No underline */
      font-weight: 600;     /* Semi-bold */
    }

    /* ✅ Hover effect for nav links */
    nav .nav-links a:hover {
      color: #dbeafe;       /* Lighter blue on hover */
    }

    /* ✅ FAQ container styling */
    .faq-container {
      max-width: 750px;     /* Limit width */
      margin: 2rem auto;    /* Center with top margin */
      background-color: var(--white); /* White card background */
      color: var(--text);   /* Dark text inside card */
      padding: 2rem;        /* Inner spacing */
      border-radius: var(--radius); /* Rounded corners */
      box-shadow: 0 12px 30px rgba(0,0,0,0.08); /* Subtle shadow */
    }

    /* ✅ Main FAQ heading */
    h1 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    /* ✅ Section subheadings */
    h2 {
      font-size: 1.3rem;
      margin-top: 2rem;
      margin-bottom: 1rem;
      font-weight: 600;
    }

    /* ✅ Individual FAQ card */
    .faq-card {
      background-color: #f1f5f9; /* Light grey */
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* ✅ FAQ title */
    .faq-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1e3a8a; /* Dark blue */
      margin-bottom: 0.5rem;
    }

    /* ✅ FAQ question text */
    .faq-question {
      font-size: 1rem;
      color: var(--text);
      margin-bottom: 0.75rem;
    }

    /* ✅ FAQ answer box */
    .faq-answer {
      background-color: var(--green-bg); /* Light green bg */
      color: var(--green);               /* Green text */
      border-left: 4px solid var(--green); /* Green side border */
      padding: 0.75rem 1rem;
      border-radius: 8px;
    }

    /* ✅ Form labels */
    form label {
      display: block;
      margin-top: 1.5rem;
      font-weight: 600;
    }

    /* ✅ Input and textarea styling */
    input, textarea {
      width: 100%;
      padding: 0.75rem;
      margin-top: 0.5rem;
      border-radius: var(--radius);
      border: 1px solid #e5e7eb;
      font-size: 1rem;
    }

    /* ✅ Allow textarea vertical resize only */
    textarea {
      resize: vertical;
    }

    /* ✅ Submit button styling */
    button {
      margin-top: 2rem;
      background-color: var(--bg-blue);
      color: var(--white);
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: var(--radius);
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      width: 100%;
    }

    /* ✅ Button hover effect */
    button:hover {
      background-color: #1e3a8a; /* Darker blue on hover */
    }

    /* ✅ Success message box */
    .success {
      background-color: var(--green-bg);
      color: var(--green);
      padding: 1rem;
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
      text-align: center;
    }

    /* ✅ Responsive adjustments */
    @media (max-width: 600px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
      }

      .nav-links {
        margin-top: 1rem;
      }

      .nav-links a {
        display: block;
        margin: 0.5rem 0;
      }
    }

    /* ✅ Back button styling (same as other pages) */
    .back-button {
      display: inline-block;
      margin: 1rem 6%;
      color: var(--white);
      font-size: 0.95rem;
      text-decoration: none;
      border: 1px solid var(--white);
      padding: 0.5rem 1rem;
      border-radius: 12px;
      transition: background-color 0.2s ease, color 0.2s ease;
    }

    .back-button:hover {
      background-color: var(--white);
      color: var(--bg-blue);
    }
  </style>
</head>
<body>

<!-- ✅ Navbar with dynamic logo link -->
<nav>
  <!-- ✅ Dynamic logo link based on user type -->
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
  <div class="nav-links">
    <a href="{{ route('about') }}">About Us</a>
    <a href="{{ route('faq') }}">FAQ</a>
    <a href="#">Contact</a>
  </div> 
</nav>

<!-- ✅ Back button under navbar -->
<a href="{{ url('/') }}" class="back-button">← Terug</a>

<!-- ✅ FAQ container -->
<div class="faq-container">
  <h1>Veelgestelde Vragen</h1> <!-- Page title -->

  {{-- ✅ Success message --}}
  @if (session('success'))
    <div class="success">{{ session('success') }}</div>
  @endif

  {{-- ✅ Display published FAQs --}}
  @if ($faqs->count())
    @foreach ($faqs as $faq)
      <div class="faq-card">
        <h3 class="faq-title">{{ $faq->subject }}</h3>
        <p class="faq-question"><strong>Vraag:</strong> {{ $faq->question }}</p>
        <div class="faq-answer">
          <strong>Antwoord:</strong>
          <p>{{ $faq->answer }}</p>
        </div>
      </div>
    @endforeach
  @else
    <p>Er zijn nog geen vragen beantwoord.</p>
  @endif

  {{-- ✅ Form to submit a new question --}}
  <h2>Stel een nieuwe vraag</h2>

  <form action="{{ route('faq.store') }}" method="POST">
    @csrf
    <label for="subject">Onderwerp</label>
    <input type="text" id="subject" name="subject" required>

    <label for="question">Vraag</label>
    <textarea id="question" name="question" rows="5" required></textarea>

    <button type="submit">Verstuur mijn vraag</button>
  </form>
</div>

</body>
</html>
