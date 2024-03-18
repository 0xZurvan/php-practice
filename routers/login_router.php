<?php
require_once dirname(__DIR__) . '/controllers/login_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $password = $_POST['password'];

  if (empty($name) || empty($password)) {
    $error_message = 'Please fill in both name and password.';
  } else {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
      $loginController = new LoginController();
      $loginController->submitForm($name, $hashed_password);
      header("Location: /views/dashboard.php");
      exit;
    } catch (Throwable $th) {
      // Handle other routes or show a 404 error
      http_response_code(404);
      echo "Error: " . $th->getMessage();
    }
    exit;
  }
}
