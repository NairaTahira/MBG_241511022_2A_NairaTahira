<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Exam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #ffffffff, #abffcaff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .register-card {
      width: 100%;
      max-width: 480px;
      border-radius: 18px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      animation: fadeIn 0.6s ease;
    }
    .register-header {
      background: #28a745;
      color: white;
      padding: 30px 20px;
      text-align: center;
      border-bottom: 4px solid #218838;
    }
    .register-header h3 {
      margin-bottom: 5px;
      font-weight: bold;
    }
    .form-control {
      border-radius: 10px;
      padding: 12px;
    }
    .btn-success {
      border-radius: 10px;
      padding: 12px;
      font-size: 1rem;
      font-weight: 500;
      transition: all 0.2s ease-in-out;
    }
    .btn-success:hover {
      background-color: #218838;
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
      color: #28a745;
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

<div class="card register-card">
  <div class="register-header">
    <h3><i class="bi bi-person-plus-fill"></i> Academic Portal</h3>
    <p class="mb-0">Create your account</p>
  </div>
  <div class="card-body p-4">

    <!-- Flash Messages -->
    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form id="registerForm" class="needs-validation" method="post" action="/auth/storeRegister" novalidate>
      <!-- Student Name -->
      <div class="mb-3">
        <label for="name" class="form-label">Username</label>
        <input type="text" 
               class="form-control" 
               id="name" 
               name="name" 
               minlength="3" 
               maxlength="50" 
               required>
        <div class="invalid-feedback">Student name is required (3–50 characters).</div>
      </div>

      <!-- NIM
      <div class="mb-3">
        <label for="nim" class="form-label"></label>
        <input type="text" 
               class="form-control" 
               id="nim" 
               name="nim" 
               pattern="^[0-9]{8,12}$" 
               minlength="8" 
               maxlength="12" 
               required>
        <div class="invalid-feedback">NIM must be 8–12 digits.</div>
        <small class="text-muted">This will also serve as your password</small>
      </div> -->

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email (Company Email)</label>
        <input type="email" 
               class="form-control" 
               id="email" 
               name="email" 
               pattern="^[a-zA-Z0-9._%+-]+@mbg.id$" 
               maxlength="100" 
               required>
        <div class="invalid-feedback">Enter a valid email (example@mbg.id).</div>
      </div>

      <button type="submit" class="btn btn-success w-100">
        <i class="bi bi-person-plus"></i> Register
      </button>
    </form>

    <div class="footer-text">
      Already registered? <a href="/login">Sign in instead</a>
    </div>
  </div>
</div>

<!-- Bootstrap validation script -->
<script>
  (() => {
    'use strict';
    const form = document.getElementById('registerForm');
    form.addEventListener('submit', event => {
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
