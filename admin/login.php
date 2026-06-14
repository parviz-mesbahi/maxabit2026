<?php
session_start();
require __DIR__ . '/config.php';

define('REDIRECT_AFTER', './');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    if ($user === ADMIN_USER && $pass === ADMIN_PASSWORD) {
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        header('Location: ' . REDIRECT_AFTER);
        exit;
    }
    $error = 'Benutzername oder Passwort ist falsch.';
}

if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: ' . REDIRECT_AFTER);
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Anmelden – MaxaBit IT-Solutions</title>
  <link rel="stylesheet" href="../css/fonts.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --ink:    #0F172A;
      --sky-d:  #0EA5E9;
      --sky-xl: #F0F9FF;
      --border: #E2E8F0;
      --muted:  #64748B;
      --sans:   'Instrument Sans', system-ui, sans-serif;
      --display:'Inter', system-ui, sans-serif;
    }

    body {
      font-family: var(--sans);
      background: var(--sky-xl);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }

    .login-logo {
      display: flex; align-items: center; gap: 10px;
      text-decoration: none; margin-bottom: 32px;
    }
    .logo-mark {
      width: 36px; height: 36px; border-radius: 10px;
      background: linear-gradient(135deg, #38BDF8, #0EA5E9);
      position: relative; flex-shrink: 0;
    }
    .logo-mark::after {
      content: ''; position: absolute; inset: 7px;
      background: #fff; border-radius: 4px;
      clip-path: polygon(50% 0%, 100% 100%, 0% 100%);
    }
    .logo-text {
      font-family: 'Outfit', var(--sans);
      font-size: 1.15rem; font-weight: 800;
      color: var(--ink); letter-spacing: -.02em;
    }
    .logo-text span { color: var(--sky-d); }

    .login-card {
      background: #fff; border: 1px solid var(--border);
      border-radius: 16px; padding: 40px 36px;
      width: 100%; max-width: 420px;
      box-shadow: 0 8px 40px rgba(14,165,233,.08), 0 2px 8px rgba(0,0,0,.04);
    }
    .login-card h1 {
      font-family: var(--display); font-size: 1.5rem; font-weight: 800;
      color: var(--ink); letter-spacing: -.02em; margin-bottom: 6px;
    }
    .login-card p { font-size: .88rem; color: var(--muted); margin-bottom: 28px; }

    .error-box {
      background: #FEF2F2; border: 1px solid #FECACA; color: #DC2626;
      border-radius: 8px; padding: 10px 14px; font-size: .85rem; margin-bottom: 20px;
    }

    .field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .field label { font-size: .78rem; font-weight: 600; color: var(--ink); letter-spacing: .02em; }
    .field input {
      border: 1.5px solid var(--border); border-radius: 8px;
      padding: 11px 14px; font-size: .95rem; font-family: var(--sans);
      color: var(--ink); outline: none; transition: border-color .15s; width: 100%;
    }
    .field input:focus { border-color: var(--sky-d); }
    .field input::placeholder { color: #CBD5E1; }

    .btn-login {
      width: 100%; margin-top: 8px; background: var(--sky-d);
      color: #fff; border: none; border-radius: 100px; padding: 13px;
      font-size: .95rem; font-weight: 700; font-family: var(--sans);
      cursor: pointer; transition: background .15s, transform .15s;
      box-shadow: 0 4px 16px rgba(14,165,233,.3);
    }
    .btn-login:hover { background: #0284C7; transform: translateY(-1px); }

    .login-back {
      display: block; text-align: center; margin-top: 20px;
      font-size: .82rem; color: var(--muted); text-decoration: none;
    }
    .login-back:hover { color: var(--sky-d); }
  </style>
</head>
<body>

  <a href="../" class="login-logo">
    <span class="logo-mark"></span>
    <span class="logo-text">MaxaBit <span>IT-Solutions</span></span>
  </a>

  <div class="login-card">
    <h1>Anmelden</h1>
    <p>Melde dich an, um Inhalte zu verwalten.</p>

    <?php if ($error): ?>
    <div class="error-box"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="field">
        <label for="username">Benutzername</label>
        <input type="text" id="username" name="username"
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
               placeholder="admin" required autofocus autocomplete="username">
      </div>
      <div class="field">
        <label for="password">Passwort</label>
        <input type="password" id="password" name="password"
               placeholder="••••••••" required autocomplete="current-password">
      </div>
      <button type="submit" class="btn-login">Anmelden</button>
    </form>

    <a href="../" class="login-back">← Zurück zur Website</a>
  </div>

</body>
</html>
