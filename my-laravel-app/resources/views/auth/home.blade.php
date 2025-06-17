<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>CareerLaunch – Start je toekomst</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-orange: #FF5A30;
      --text-white: #ffffff;
      --btn-white: #ffffff;
      --btn-text: #1C1C1C;
      --radius: 100px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-orange);
      color: var(--text-white);
      scroll-behavior: smooth;
    }

    /* Navbar */
    .navbar {
      position: sticky;
      top: 0;
      width: 100%;
      background-color: var(--bg-orange);
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
      color: #ffffff;
    }

    .nav-links a {
      margin-left: 2rem;
      text-decoration: none;
      color: #ffffff;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #000000;
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

    /* Hero Section */
    .main-section {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      min-height: 100vh;
      padding: 4rem 6%;
      gap: 2rem;
      flex-wrap: wrap;
    }

    .text-content {
      max-width: 500px;
      animation: fadeInUp 1s ease-out forwards;
    }

    .text-content h1 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
    }

    .text-content p {
      font-size: 1.2rem;
      color: #ffede5;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .cta-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .cta-buttons a {
      background-color: var(--btn-white);
      color: var(--btn-text);
      padding: 0.9rem 1.6rem;
      font-weight: 600;
      border-radius: var(--radius);
      text-decoration: none;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .cta-buttons a:hover {
      background-color: #000000;
      color: #ffffff;
    }

    /* iPhone Mockup */
    .phone-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .iphone-frame {
      position: relative;
      width: 340px;
      height: 680px;
      background: #0A3D2D;
      border-radius: 60px;
      padding: 1rem;
      box-shadow: 0 30px 60px rgba(0,0,0,0.35);
      border: 6px solid #000;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .volume-buttons {
      position: absolute;
      left: -12px;
      top: 70px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .volume-buttons div {
      width: 6px;
      background: #333;
      border-radius: 10px;
    }

    .mute-switch {
      height: 20px;
    }

    .volume-up,
    .volume-down {
      height: 40px;
    }

    .power-button {
      position: absolute;
      right: -12px;
      top: 100px;
      width: 6px;
      height: 60px;
      background: #333;
      border-radius: 10px;
    }

    .dynamic-island {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: 120px;
      height: 34px;
      background: #111;
      border-radius: 22px;
      z-index: 2;
    }

    .chat-mockup {
      width: 100%;
      height: 100%;
      padding-top: 70px;
      padding-bottom: 20px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }

    .chat-header {
      color: #25D366;
      font-weight: bold;
      font-size: 1rem;
      text-align: center;
      margin-bottom: 1rem;
    }

    .chat-body {
      background: white;
      flex-grow: 1;
      border-radius: 25px;
      padding: 1rem;
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
      overflow-y: auto;
    }

    .bubble {
      padding: 0.7rem 1rem;
      border-radius: 18px;
      font-size: 0.95rem;
      max-width: 85%;
      line-height: 1.4;
      word-wrap: break-word;
      opacity: 0;
      animation: fadeIn 0.4s ease forwards;
    }

    .bubble.student {
      background: #f1f1f1;
      color: #000;
      align-self: flex-start;
      animation-delay: 0.4s;
    }

    .bubble.bot {
      background: #FF5A30;
      color: white;
      align-self: flex-end;
    }

    .bubble:nth-child(2) { animation-delay: 0.8s; }
    .bubble:nth-child(3) { animation-delay: 1.2s; }
    .bubble:nth-child(4) { animation-delay: 1.6s; }

    .home-indicator {
      width: 120px;
      height: 5px;
      background-color: rgba(255, 255, 255, 0.6);
      border-radius: 4px;
      margin: 12px auto 0;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      to { opacity: 1; }
    }

    @media (max-width: 960px) {
      .main-section {
        flex-direction: column;
        text-align: center;
        padding: 2rem;
      }

      .text-content h1 {
        font-size: 2.5rem;
      }

      .cta-buttons {
        justify-content: center;
      }

      .cta-buttons a {
        width: 100%;
        max-width: 300px;
        text-align: center;
      }

      .phone-wrapper {
        transform: none;
        display: flex;
        justify-content: center;
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <!-- ✅ Navbar -->
  <header class="navbar">
    <div class="nav-container">
      <div class="logo">CareerLaunch</div>
      <nav class="nav-links">
        <a href="#about">About Us</a>
        <a href="#faq">FAQ</a>
        <a href="#contact">Contact</a>
      </nav>
    </div>
  </header>

  <!-- ✅ Hero + iPhone mockup -->
  <section class="main-section">
    <div class="text-content">
      <h1>Start je carrière met één klik</h1>
      <p>CareerLaunch helpt studenten en bedrijven elkaar snel te vinden. Kies je rol en ontdek nieuwe opportuniteiten.</p>
      <div class="cta-buttons">
        <a href="{{ route('login.student') }}">Ik ben student</a>
        <a href="{{ route('login.bedrijf') }}">Ik ben bedrijf</a>
      </div>
    </div>

    <div class="phone-wrapper">
      <div class="iphone-frame">
        <div class="volume-buttons">
          <div class="mute-switch"></div>
          <div class="volume-up"></div>
          <div class="volume-down"></div>
        </div>
        <div class="power-button"></div>
        <div class="dynamic-island"></div>
        <div class="chat-mockup">
          <div class="chat-header">WhatsApp</div>
          <div class="chat-body">
            <div class="bubble student">Hi 👋</div>
            <div class="bubble bot">Hallo! 👋 Welkom bij CareerLaunch. Ben je op zoek naar een stage of job?</div>
            <div class="bubble student">Ik zoek een stage voor webontwikkeling.</div>
            <div class="bubble bot">Super! We tonen je graag enkele bedrijven die bij jouw profiel passen.</div>
          </div>
          <div class="home-indicator"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Placeholder secties -->
  <section id="about"></section>
  <section id="faq"></section>
  <section id="contact"></section>

</body>
</html>
