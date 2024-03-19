<?php

require_once dirname(__DIR__) . '/models/auth_model.php';

class AuthController
{
  public function signUp($name, $hashed_password)
  {
    $authModel = new AuthModel();
    $manager = $authModel->signUp($name, $hashed_password);

    if ($manager) {
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }

      $_SESSION['manager'] = $manager;
    } else {
      return false;
    }
  }

  public function login($name, $password)
  {
    $authModel = new AuthModel();
    $manager = $authModel->login($name, $password);

    if ($manager) {
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }

      $_SESSION['manager'] = $manager;
    } else {
      return false;
    }
  }
}
