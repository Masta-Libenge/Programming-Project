<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>FAQ – CareerLaunch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #1E40AF;
      --bg: #1E40AF;
      --white: #ffffff;
      --text: #0f172a;
      --muted: #64748b;
      --green: #065f46;
      --green-bg: #d1fae5;
      --radius: 16px;
    }

    * {
      box-sizing: border-box;
      margin: 0; padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg);
      color: var(--text);
    }

    /* ✅ Navbar same as Dashboard */
    .navbar {
      position: sticky;
      top: 0;
      width: 100%;
      background-color: var(--primary);
      padding: 1rem 6%;
      z-index: 999;
    }

    .nav-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
    }

    .logo {
      font-size: 1.4rem;
      font-weight: 800;
      color: var(--white);
      text-decoration: none;
    }

    .nav-links a {
      margin-left: 2rem;
      text-decoration: none;
      color: var(--white);
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #dbeafe;
    }

    @media (max-width: 768px) {
      .nav-container {
        flex-direction: column;
        align-items: flex-start;
      }

      .nav-links {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 1rem;
      }

      .nav-links a {
        margin-left: 0;
      }
    }

    /* ✅ Container same spacing as Dashboard content */
    .faq-wrapper {
      max-width: 960px;
      margin: 4rem auto;
      padding: 0 1.5rem;
      color: var(--text);
    }

    .faq-container {
      background-color: var(--white);
      border-radius: var(--radius);
      padding: 2rem;
      box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }

    h1 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    h2 {
      font-size: 1.3rem;
      margin-top: 2rem;
      margin-bottom: 1rem;
      font-weight: 600;
    }

    .faq-card {
      background-color: #f1f5f9;
      border-radius: var(--radius);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .faq-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #1e3a8a;
      margin-bottom: 0.5rem;
    }

    .faq-question {
      font-size: 1rem;
      color: var(--text);
      margin-bottom: 0.75rem;
    }

    .faq-answer {
      background-color: var(--green-bg);
      color: var(--green);
      border-left: 4px solid var(--green);
      padding: 0.75rem 1rem;
      border-radius: 8px;
    }

    form label {
      display: block;
      margin-top: 1.5rem;
      font-weight: 600;
    }

    input, textarea {
      width: 100%;
      padding: 0.75rem;
      margin-top: 0.5rem;
      border-radius: var(--radius);
      border: 1px solid #e5e7eb;
      font-size: 1rem;
    }

    textarea {
      resize: vertical;
    }

    button {
      margin-top: 2rem;
      background-color: var(--primary);
      color: var(--white);
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: var(--radius);
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #1e3a8a;
    }

    .success {
      background-color: var(--green-bg);
      color: var(--green);
      padding: 1rem;
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
      text-align: center;
    }
  </style>
</head>
<body>

<!-- ✅ Matching Navbar -->
<header class="navbar">
  <div class="nav-container">
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

    <nav class="nav-links">
      <a href="#">Planning</a>
      <a href="{{ route('about') }}">About Us</a>
      <a href="{{ route('faq') }}">FAQ</a>
      <a href="#">Contact</a>
      <a href="{{ route('student.profile.show') }}">Profiel</a>
    </nav>
  </div>
</header>

<!-- ✅ FAQ matches Dashboard spacing -->
<div class="faq-wrapper">
  <div class="faq-container">
    <h1>Veelgestelde Vragen</h1>

    @if (session('success'))
      <div class="success">{{ session('success') }}</div>
    @endif

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
</div>

</body>
</html>
