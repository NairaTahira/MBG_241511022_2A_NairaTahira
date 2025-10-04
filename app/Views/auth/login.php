<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Exam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #d2e7ffff, #91baff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-card {
      width: 100%;
      max-width: 420px;
      border-radius: 18px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.12);
      animation: fadeIn 0.6s ease;
    }
    .login-header {
      background: #007bff;
      color: white;
      padding: 25px;
      text-align: center;
      border-bottom: 4px solid #0056b3;
    }
    .login-header h3 {
      margin-bottom: 5px;
      font-weight: bold;
    }
    .form-control {
      border-radius: 10px;
      padding: 12px;
    }
    .btn-primary {
      border-radius: 10px;
      padding: 12px;
      font-size: 1rem;
      font-weight: 500;
      transition: all 0.2s ease-in-out;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      transform: scale(1.02);
    }
    .footer-text {
      font-size: 0.9rem;
      color: #6c757d;
      text-align: center;
      margin-top: 15px;
    }
    .footer-text a {
      text-decoration: none;
      color: #007bff;
      font-weight: 500;
    }
    .footer-text a:hover {
      text-decoration: underline;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<div class="card login-card">
  <div class="login-header">
    <h3><i class="bi bi-mortarboard-fill"></i> Login</h3>
    <p class="mb-0">Login to continue</p>
  </div>
  <div class="card-body p-4">

    <!-- Flash Messages -->
    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Login Form -->
    <form id="loginForm" method="post" action="/auth/checkLogin" novalidate>
      <div class="mb-3">
        <label for="email" class="form-label">Email </label>
        <input type="email" 
               class="form-control" 
               id="email" 
               name="email" 
               maxlength="50" 
               required
               autocomplete="off"
               placeholder="Enter your Email">
        <div class="invalid-feedback">Valid Email is required (max 50 chars).</div>
        <small class="text-muted">(Max 50 characters)</small>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password </label>
        <input type="password" 
               class="form-control" 
               id="password" 
               name="password" 
               minlength="5" 
               required
               autocomplete="new-password"
               placeholder="Enter your password">
        <div class="invalid-feedback">Password is required (must be at least 5 characters.)</div>
        <small class="text-muted">(Min 5 characters)</small>
      </div>

      <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-box-arrow-in-right"></i> Login
      </button>
    </form>

    <div class="footer-text">
      Don’t have an account? <a href="/register">Sign up!</a>
    </div>
  </div>
</div>

<script>
  // Bootstrap style validation
  (function () {
    'use strict'
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  })();
</script>

</body>
</html>
