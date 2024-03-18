<?php

require_once dirname(__DIR__) . '/models/login_model.php';

class LoginController
{
  public function submitForm($name, $hashed_password)
  {
    $loginModel = new LoginModel();
    $loginModel->login($name, $hashed_password);

    $response = ['message' => 'Form submitted successfully'];
    return $response;
  }
}