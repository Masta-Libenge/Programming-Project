<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8"> <!-- Character encoding -->
  <title>FAQ – CareerLaunch</title> <!-- Page title -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Make responsive -->
  <!-- Google font for Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  
  <style>
    /* CSS variables for consistent colors and radius */
    :root {
      --bg-blue: #1E40AF; /* Dark blue background */
      --white: #ffffff; /* White */
      --text: #0f172a; /* Dark text */
      --muted: #64748b; /* Muted grey */
      --green: #065f46; /* Green text */
      --green-bg: #d1fae5; /* Light green bg */
      --radius: 12px; /* Standard border radius */
    }

    /* Universal reset and box model fix */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* Base body styling */
    body {
      font-family: 'Inter', sans-serif; /* Font */
      background-color: var(--bg-blue); /* Dark blue bg */
      color: var(--white); /* White text by default */
      min-height: 100vh; /* Full height */
      padding-top: 80px; /* Space for fixed nav */
    }

    /* Navbar styling */
    nav {
      background: var(--bg-blue); /* Same dark blue */
      position: fixed; /* Fix at top */
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000; /* On top */
      display: flex; /* Flex layout */
      justify-content: space-between; /* Space between logo and links */
      align-items: center; /* Center vertically */
      padding: 1rem 6%; /* Space inside nav */
      box-shadow: 0 4px 10px rgba(0,0,0,0.1); /* Subtle shadow */
    }

    /* Logo inside nav */
    nav .logo {
      font-size: 1.4rem; /* Larger text */
      font-weight: 800; /* Extra bold */
      color: var(--white); /* White text */
    }

    /* Nav links style */
    nav .nav-links a {
      margin-left: 2rem; /* Space between links */
      color: var(--white); /* White text */
      text-decoration: none; /* Remove underline */
      font-weight: 600; /* Bold links */
    }

    /* Hover effect for nav links */
    nav .nav-links a:hover {
      color: #dbeafe; /* Lighter blue on hover */
    }

    /* Container for FAQ content */
    .faq-container {
      max-width: 750px; /* Max width */
      margin: 2rem auto; /* Centered with top margin */
      background-color: var(--white); /* White background */
      color: var(--text); /* Dark text inside */
      padding: 2rem; /* Padding inside */
      border-radius: var(--radius); /* Rounded corners */
      box-shadow: 0 12px 30px rgba(0,0,0,0.08); /* Subtle shadow */
    }

    /* FAQ main heading */
    h1 {
      font-size: 2rem; /* Large title */
      font-weight: 700; /* Bold */
      margin-bottom: 1.5rem; /* Space below */
      text-align: center; /* Centered */
    }

    /* Subheadings */
    h2 {
      font-size: 1.3rem; /* Smaller than main title */
      margin-top: 2rem; /* Space above */
      margin-bottom: 1rem; /* Space below */
      font-weight: 600; /* Semi-bold */
    }

    /* Each FAQ card style */
    .faq-card {
      background-color: #f1f5f9; /* Light grey background */
      border-radius: 12px; /* Rounded corners */
      padding: 1.5rem; /* Padding inside */
      margin-bottom: 1.5rem; /* Space below */
      box-shadow: 0 4px 12px rgba(0,0,0,0.05); /* Subtle shadow */
    }

    /* FAQ card title */
    .faq-title {
      font-size: 1.2rem; /* Title size */
      font-weight: 700; /* Bold */
      color: #1e3a8a; /* Dark blue */
      margin-bottom: 0.5rem; /* Space below */
    }

    /* FAQ question text */
    .faq-question {
      font-size: 1rem; /* Normal text */
      color: var(--text); /* Dark text */
      margin-bottom: 0.75rem; /* Space below */
    }

    /* FAQ answer box */
    .faq-answer {
      background-color: var(--green-bg); /* Light green bg */
      color: var(--green); /* Dark green text */
      border-left: 4px solid var(--green); /* Green side border */
      padding: 0.75rem 1rem; /* Padding inside */
      border-radius: 8px; /* Rounded corners */
    }

    /* Label styling for form */
    form label {
      display: block; /* Make label take full width */
      margin-top: 1.5rem; /* Space above */
      font-weight: 600; /* Semi-bold */
    }

    /* Input and textarea fields */
    input, textarea {
      width: 100%; /* Full width */
      padding: 0.75rem; /* Inside padding */
      margin-top: 0.5rem; /* Space above field */
      border-radius: var(--radius); /* Rounded corners */
      border: 1px solid #e5e7eb; /* Light grey border */
      font-size: 1rem; /* Normal text */
    }

    /* Allow textarea resizing vertically only */
    textarea {
      resize: vertical;
    }

    /* Submit button style */
    button {
      margin-top: 2rem; /* Space above */
      background-color: var(--bg-blue); /* Same blue as nav */
      color: var(--white); /* White text */
      padding: 0.75rem 1.5rem; /* Inside padding */
      border: none; /* No border */
      border-radius: var(--radius); /* Rounded corners */
      font-weight: 600; /* Bold text */
      font-size: 1rem; /* Font size */
      cursor: pointer; /* Pointer cursor */
      width: 100%; /* Full width button */
    }

    /* Button hover effect */
    button:hover {
      background-color: #1e3a8a; /* Darker blue on hover */
    }

    /* Success message box */
    .success {
      background-color: var(--green-bg); /* Light green */
      color: var(--green); /* Green text */
      padding: 1rem; /* Inside padding */
      border-radius: var(--radius); /* Rounded corners */
      margin-bottom: 1.5rem; /* Space below */
      text-align: center; /* Center text */
    }

    /* Responsive adjustments for small screens */
    @media (max-width: 600px) {
      nav {
        flex-direction: column; /* Stack nav items */
        align-items: flex-start; /* Align left */
      }

      .nav-links {
        margin-top: 1rem; /* Space above links */
      }

      .nav-links a {
        display: block; /* Links on own lines */
        margin: 0.5rem 0; /* Vertical space */
      }
    }

    /* ✅ Back button styling same as other pages */
    .back-button {
      display: inline-block; /* Inline block */
      margin: 1rem 6%; /* Match nav horizontal padding */
      color: var(--white); /* White text */
      font-size: 0.95rem; /* Font size */
      text-decoration: none; /* No underline */
      border: 1px solid var(--white); /* White border */
      padding: 0.5rem 1rem; /* Inside padding */
      border-radius: 12px; /* Match --radius */
      transition: background-color 0.2s ease, color 0.2s ease; /* Smooth hover */
    }

    .back-button:hover {
      background-color: var(--white); /* Fill white on hover */
      color: var(--bg-blue); /* Text turns blue */
    }
  </style>
</head>
<body>

<!-- ✅ Navbar -->
<nav>
  <div class="logo">CareerLaunch</div> <!-- Logo -->
  <div class="nav-links">
    <a href="{{ route('about') }}">About Us</a> <!-- Link to About page -->
    <a href="{{ route('faq') }}">FAQ</a> <!-- Link to FAQ page -->
    <a href="#">Contact</a> <!-- Contact link -->
  </div> 
</nav>

<!-- ✅ Back button under navbar -->
<a href="{{ url('/') }}" class="back-button">← Terug</a> <!-- Back button to homepage -->

<!-- ✅ FAQ container -->
<div class="faq-container">
  <h1>Veelgestelde Vragen</h1> <!-- Main title -->

  {{-- Success message --}}
  @if (session('success'))
    <div class="success">{{ session('success') }}</div>
  @endif

  {{-- Published FAQs --}}
  @if ($faqs->count())
    @foreach ($faqs as $faq)
      <div class="faq-card">
        <h3 class="faq-title">{{ $faq->subject }}</h3> <!-- FAQ subject -->
        <p class="faq-question"><strong>Vraag:</strong> {{ $faq->question }}</p> <!-- The question -->
        <div class="faq-answer">
          <strong>Antwoord:</strong>
          <p>{{ $faq->answer }}</p> <!-- The answer -->
        </div>
      </div>
    @endforeach
  @else
    <p>Er zijn nog geen vragen beantwoord.</p> <!-- Message if no FAQs -->
  @endif

  {{-- Question submission form --}}
  <h2>Stel een nieuwe vraag</h2> <!-- Form title -->

  <form action="{{ route('faq.store') }}" method="POST">
    @csrf <!-- CSRF protection -->

    <label for="subject">Onderwerp</label> <!-- Subject label -->
    <input type="text" id="subject" name="subject" required> <!-- Subject input -->

    <label for="question">Vraag</label> <!-- Question label -->
    <textarea id="question" name="question" rows="5" required></textarea> <!-- Question textarea -->

    <button type="submit">Verstuur mijn vraag</button> <!-- Submit button -->
  </form>
</div>

</body>
</html>
