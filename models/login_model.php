<?php

require_once dirname(__DIR__) . '/db/database.php';

class LoginModel
{
  private static $pdo = null;

  function __construct()
  {
    self::$pdo = Database::connectDB();
  }

  public function login($name, $password)
  {
    try {
      $query = "INSERT INTO managers (name, password) VALUES (:name, :password)";
      $stmt = self::$pdo->prepare($query);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':password', $password);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
