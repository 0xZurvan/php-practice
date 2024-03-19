<?php

require_once dirname(__DIR__) . '/controllers/auth_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $authController = new AuthController();
  if (isset($_GET['action'])) {
    switch ($_GET['action']) {
      case 'sign-up':
        if (isset($_POST['name'], $_POST['password'])) {
          $name = $_POST['name'];
          $password = $_POST['password'];
          $hashed_password = password_hash($password, PASSWORD_BCRYPT);

          try {
            $authController->signUp($name, $hashed_password);

            header("Location: /views/dashboard.php");
            exit;
          } catch (Throwable $th) {
            http_response_code(404);
            echo "Error: " . $th->getMessage();
          }
        }
        break;

      case 'login':
        if (isset($_POST['name'], $_POST['password'])) {
          $name = $_POST['name'];
          $password = $_POST['password'];

          try {
            $authController->login($name, $password);

            header("Location: /views/dashboard.php");
            exit;
          } catch (Throwable $th) {
            http_response_code(404);
            echo "Error: " . $th->getMessage();
          }
        }
        break;

      default:
        http_response_code(404);
        echo "Invalid action";
        break;
    }
  } else {
    http_response_code(404);
    echo "No action specified";
  }
}
