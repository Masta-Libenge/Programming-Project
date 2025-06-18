<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8"> <!-- Character encoding for Dutch -->
  <title>Inloggen als student – CareerLaunch</title> <!-- Page title shown in the browser tab -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Make page responsive -->
  <!-- Import Google Inter font with weights 400, 600, 800 -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
    /* ✅ CSS variables for consistent theme colors and border radius */
    :root {
      --primary: #1E40AF;    /* Main blue color */
      --secondary: #F1F5F9;  /* Light background color */
      --card-bg: #ffffff;    /* Card background */
      --text-dark: #0f172a;  /* Dark text color */
      --muted: #64748b;      /* Muted text color */
      --radius: 16px;        /* Standard border radius */
    }

    /* ✅ Reset and box model fix */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* ✅ Page base styling */
    body {
      background-color: var(--secondary); /* Light grey background */
      font-family: 'Inter', sans-serif;   /* Use Inter font */
      display: flex;                      /* Use flex layout to center card */
      justify-content: center;
      align-items: center;
      min-height: 100vh;                  /* Full viewport height */
      padding: 2rem;                      /* Space on small screens */
      color: var(--text-dark);            /* Dark text by default */
    }

    /* ✅ Login card styling */
    .login-container {
      background: var(--card-bg);         /* White card background */
      border-radius: var(--radius);       /* Rounded corners */
      padding: 3rem 2rem;                 /* Inner spacing */
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06); /* Subtle shadow */
      width: 100%;
      max-width: 460px;                   /* Max card width */
    }

    /* ✅ Main heading style */
    h1 {
      font-size: 2.2rem;                  /* Large heading */
      font-weight: 800;                   /* Extra bold */
      text-align: center;
      color: var(--primary);              /* Blue text */
      margin-bottom: 0.5rem;              /* Space below heading */
    }

    /* ✅ Subtitle paragraph */
    p {
      font-size: 1rem;                    /* Normal text size */
      text-align: center;                 /* Centered text */
      color: var(--muted);                /* Muted color */
      margin-bottom: 2rem;                /* Space below paragraph */
    }

    /* ✅ Label styling for form fields */
    label {
      font-weight: 600;                   /* Semi-bold */
      display: block;
      margin-bottom: 0.4rem;
      margin-top: 1.2rem;                 /* Space above each label */
    }

    /* ✅ Input fields styling */
    input[type="email"],
    input[type="password"] {
      width: 100%;                        /* Full width */
      padding: 0.85rem;                   /* Inner padding */
      font-size: 1rem;                    /* Text size */
      border: 1px solid #e2e8f0;          /* Light grey border */
      border-radius: var(--radius);       /* Rounded corners */
      background-color: #f9fafb;          /* Light input background */
    }

    /* ✅ Submit button styling */
    button {
      width: 100%;                        /* Full width */
      margin-top: 2rem;                   /* Space above */
      padding: 0.9rem;                    /* Inner padding */
      font-size: 1rem;                    /* Text size */
      font-weight: 600;                   /* Bold text */
      border: none;                       /* Remove default border */
      border-radius: var(--radius);       /* Rounded corners */
      background-color: var(--primary);   /* Blue background */
      color: white;                       /* White text */
      cursor: pointer;                    /* Pointer cursor on hover */
      transition: background-color 0.3s ease; /* Smooth hover effect */
    }

    /* ✅ Hover state for button */
    button:hover {
      background-color: #172B87;          /* Darker blue on hover */
    }

    /* ✅ Register link styling below form */
    .register-link {
      display: block;
      text-align: center;
      margin-top: 1.6rem;
      color: var(--primary);
      font-size: 0.95rem;
      text-decoration: none;
      font-weight: 600;
    }

    .register-link:hover {
      text-decoration: underline;
    }

    /* ✅ Back button styling (matches other pages) */
    .back-button {
      display: inline-block;              /* Inline block */
      margin-bottom: 1rem;                /* Space below */
      color: var(--primary);              /* Blue text */
      font-size: 0.95rem;                 /* Text size */
      text-decoration: none;              /* Remove underline */
      border: 1px solid var(--primary);   /* Blue border */
      padding: 0.5rem 1rem;               /* Inner padding */
      border-radius: var(--radius);       /* Rounded corners */
      transition: background-color 0.2s ease, color 0.2s ease; /* Smooth hover */
    }

    /* ✅ Hover state for back button */
    .back-button:hover {
      background-color: var(--primary);   /* Fill blue on hover */
      color: white;                       /* White text on hover */
    }

    /* ✅ Error message styling */
    .error-message {
      background-color: #fee2e2;          /* Light red background */
      color: #b91c1c;                     /* Dark red text */
      padding: 0.75rem 1rem;
      border-radius: var(--radius);
      margin-bottom: 1rem;
      font-size: 0.95rem;
    }

    .error-message ul {
      margin: 0;
      padding-left: 1rem;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- ✅ Dynamic back button: goes to previous page instead of always home -->
    <a href="{{ url()->previous() }}" class="back-button">← Terug</a>

    <!-- ✅ Login heading & subtitle -->
    <h1>Student login</h1>
    <p>Log in om toegang te krijgen tot jouw persoonlijke dashboard</p>

    <!-- ✅ Show main login error if present -->
    @if ($errors->has('login'))
      <div class="error-message" style="text-align: center;">
        {{ $errors->first('login') }}
      </div>
    @endif

    <!-- ✅ Extract other errors (not 'login') to show as list -->
    @php
      $allErrors = $errors->all();
      $loginError = $errors->first('login');
      $otherErrors = array_filter($allErrors, fn($e) => $e !== $loginError);
    @endphp

    @if (count($otherErrors) > 0)
      <div class="error-message">
        <ul>
          @foreach ($otherErrors as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- ✅ Login form -->
    <form method="POST" action="{{ url('/login/student') }}">
      @csrf <!-- Laravel CSRF token for security -->

      <label for="email">E-mailadres</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Wachtwoord</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Inloggen</button>
    </form>

    <!-- ✅ Register link below form -->
    <a href="{{ url('/register_student') }}" class="register-link">
      Nog geen account? Registreer hier
    </a>
  </div>

</body>
</html>
