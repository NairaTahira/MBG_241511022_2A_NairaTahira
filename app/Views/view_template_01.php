<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title) ?> - Template for MidTerms</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    :root {
      --bs-primary: #4b6cb7;
      --bs-primary-rgb: 75,108,183;
      --bs-success: #28a745;
      --bs-danger: #d9534f;
    }

    .navbar.bg-primary {
      background: linear-gradient(90deg, #4b6cb7, #2a4478ff);
    }
    
    .navbar {
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    /* Active menu highlight */
    .navbar-nav .nav-link.active {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      padding: 6px 12px;
      transition: background 0.3s;
    }

    .content {
      padding: 30px 15px;
    }

    footer {
      background: #343a40;
      color: #fff;
      text-align: center;
      padding: 15px;
      margin-top: 40px;
    }

    /* Global form validation styling */
    .is-invalid {
      border: 2px solid #dc3545 !important;   /* Strong red border */
      box-shadow: 0 0 6px rgba(220, 53, 69, 0.6) !important;
    }

    .is-invalid:focus {
      border-color: #dc3545 !important;
      box-shadow: 0 0 8px rgba(220, 53, 69, 0.7) !important;
    }
    .error {
      font-size: 0.85rem;
      color: #dc3545;
      margin-top: 3px;
    }

  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/home">
      <i class="bi bi-mortarboard"></i> MBG
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/home"><i class="bi bi-house-door"></i> Home</a></li>
        <?php if(session()->get('role')==='gudang'): ?>
          <li class="nav-item"><a class="nav-link" href="/courses"><i class="bi bi-journal-text"></i> Table One </a></li>
          <li class="nav-item"><a class="nav-link" href="/students"><i class="bi bi-people"></i> Table Two </a></li>
        <?php elseif(session()->get('role')==='dapur'): ?>
          <li class="nav-item"><a class="nav-link" href="/courses"><i class="bi bi-book"></i> Table One </a></li>
          <li class="nav-item"><a class="nav-link" href="/my-courses"><i class="bi bi-list-check"></i> Table Two </a></li>
        <?php endif; ?>
      </ul>
      <span class="navbar-text">
        <i class="bi bi-person-circle"></i> <?= session()->get('username') ?> |
        <a href="/login" class="btn btn-sm btn-danger ms-2">Logout</a>
      </span>
    </div>
  </div>
</nav>

<!-- Page Content -->
<div class="container content">
  <?= $content ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/common.js"></script>

<!-- Auto-highlight active menu -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".navbar-nav .nav-link");
    links.forEach(link => {
      if (window.location.pathname === link.getAttribute("href")) {
        link.classList.add("active");
      }
    });
  });
</script>

<meta name="csrf-name" content="<?= csrf_token() ?>">
<meta name="csrf-token" content="<?= csrf_hash() ?>">

<script>
document.addEventListener("DOMContentLoaded", () => {
  // Attach validation to all forms
  document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", function (e) {
      let hasError = false;

      this.querySelectorAll("input[required]").forEach(input => {
        const errorId = "error-" + input.id;
        let errorEl = document.getElementById(errorId);

        // create error span if doesn't exist
        if (!errorEl) {
          errorEl = document.createElement("div");
          errorEl.id = errorId;
          errorEl.className = "error";
          input.insertAdjacentElement("afterend", errorEl);
        }

        if (input.value.trim() === "") {
          e.preventDefault();
          hasError = true;
          input.classList.add("is-invalid");
          errorEl.textContent = input.getAttribute("placeholder") + " is required";
        } else if (input.hasAttribute("minlength") && input.value.length < input.getAttribute("minlength")) {
          e.preventDefault();
          hasError = true;
          input.classList.add("is-invalid");
          errorEl.textContent = "Minimum " + input.getAttribute("minlength") + " characters required";
        } else {
          input.classList.remove("is-invalid");
          errorEl.textContent = "";
        }
      });

      if (hasError) {
        e.stopPropagation();
      }
    });

    // Clear error as soon as user types
    form.querySelectorAll("input[required]").forEach(input => {
      input.addEventListener("input", () => {
        input.classList.remove("is-invalid");
        const errorEl = document.getElementById("error-" + input.id);
        if (errorEl) errorEl.textContent = "";
      });
    });
  });
});
</script>

</body>
</html>

