<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Home</title>
  <style>
    .main {
      margin: 20px;
      min-height: 70vh;
    }

    .content {
      margin: auto;
    }

    body {
      overflow-x: hidden;
    }
  </style>
</head>

<body>
  <div class="row  justify-content-center main">
    <!-- Navbar -->
    <div class="position-fixed top-10 d-flex flex-row justify-content-between align-items-center px-4">
      <h2 class="fs-5">Logo</h2>
      <div>
        <button onclick="redirectToSignUp()" class="btn btn-primary">Sign Up</button>
        <button onclick="redirectToLogin()" class="btn btn-success">Login</button>
      </div>
    </div>

    <!-- Content -->
    <div class="text-center content">
      <h1 class="">Welcome to employees manager</h1>
      <h3 class="fs-5">Experience the manager tools of your dreams with us!</h3>
      <p>This tool will help you keep track of all your employees, salaries, metrics, insurance, and more.</p>
      <button onclick="redirectToLogin()" class="btn btn-primary btn-md w-25">Start a new services</button>
    </div>
  </div>

  <script>
    function redirectToSignUp() {
      window.location.href = "http://localhost:3040/views/sign-up.php";
    }

    function redirectToLogin() {
      window.location.href = "http://localhost:3040/views/login.php";
    }
  </script>
</body>

</html>