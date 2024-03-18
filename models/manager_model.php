<?php

require_once dirname(__DIR__) . '/db/database.php';

class ManagerModel
{

  private static $pdo = null;

  function __construct()
  {
    self::$pdo = Database::connectDB();
  }

  // Read
  public static function getEmployeeByName($name)
  {
    try {
      $query = 'SELECT id, name, salary, insurance_id, status, location, job_title FROM employees WHERE name = :name';
      $stm = self::$pdo->prepare($query);
      $stm->bindParam(':name', $name);
      $stm->execute();

      $employee = $stm->fetchAll(PDO::FETCH_ASSOC);
      return $employee;
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public static function getAllEmployees()
  {
    try {
      $query = 'SELECT id, name, salary, insurance_id, status, location, job_title FROM employees';
      $stm = self::$pdo->prepare($query);
      $stm->execute();

      $employees = $stm->fetchAll(PDO::FETCH_ASSOC);
      return $employees;
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  // Write
  public static function registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title)
  {
    try {
      $query = 'INSERT INTO employees (name, salary, insurance_id, status, location, job_title) VALUES (:name, :salary, :insurance_id, :status, :location, :job_title)';
      $stm = self::$pdo->prepare($query);
      $stm->bindParam(':name', $name);
      $stm->bindParam(':salary', $salary);
      $stm->bindParam(':insurance_id', $insurance_id);
      $stm->bindParam(':status', $status);
      $stm->bindParam(':location', $location);
      $stm->bindParam(':job_title', $job_title);
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  // Delete
  public static function deleteEmployeeById($id)
  {
    try {
      $query = "DELETE FROM employees WHERE id = :id";
      $stm = self::$pdo->prepare($query);
      $stm->bindParam(':id', $id, PDO::PARAM_INT);
      $stm->execute();

      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}
