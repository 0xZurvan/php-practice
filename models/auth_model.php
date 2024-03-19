<?php

require_once dirname(__DIR__) . '/db/database.php';

class AuthModel
{
  private static $pdo = null;

  function __construct()
  {
    $db = new Database();
    self::$pdo = $db->connectDB();
  }

  public function signUp($name, $password)
  {
    try {
      $query = "INSERT INTO managers (name, password) VALUES (:name, :password)";
      $stmt = self::$pdo->prepare($query);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':password', $password);
      $stmt->execute();

      $id = self::$pdo->lastInsertId();

      // Fetch inserted manager
      $selectQuery = "SELECT * FROM managers WHERE id = :id";
      $selectStmt = self::$pdo->prepare($selectQuery);
      $selectStmt->bindParam(':id', $id);
      $selectStmt->execute();

      $manager = $selectStmt->fetch(PDO::FETCH_ASSOC);

      return $manager;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function login($name, $password)
  {
    try {
      $query = "SELECT * FROM managers WHERE name = :name";
      $stmt = self::$pdo->prepare($query);
      $stmt->bindParam(':name', $name);
      $stmt->execute();
      $manager = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($manager && password_verify($password, $manager['password'])) {
        return $manager;
      } else {
        echo 'Error password is incorrect!';
      }
      
    } catch (PDOException $e) {
      echo 'Error login: ' . $e->getMessage();
      return false;
    }
  }
}
