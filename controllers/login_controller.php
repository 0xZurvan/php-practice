<?php

require_once dirname(__DIR__) . '/models/login_model.php';

class UserController
{
  public function submitForm($name, $hashed_password, $role)
  {
    $loginModel = new LoginModel();
    $loginModel->login($name, $hashed_password, $role);

    $response = ['message' => 'Form submitted successfully'];
    return $response;
  }
}