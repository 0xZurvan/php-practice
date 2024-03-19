<?php

require_once dirname(__DIR__) . '/db/database.php';
class ManagerModel
{

  private static $pdo = null;

  function __construct()
  {
    if (self::$pdo === null) {
      $db = new Database();
      self::$pdo = $db->connectDB();
    } else {
      die("Failed to establish database connection.");
    }
  }

  // Read
  public function getEmployeeByName($name)
  {
    try {
      $query = 'SELECT * FROM employees WHERE name = :name';
      $stm = self::$pdo->prepare($query);
      $stm->bindParam(':name', $name);
      $stm->execute();

      $employee = $stm->fetchAll(PDO::FETCH_ASSOC);
      return $employee;
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public function getAllEmployees()
  {
    try {
      $query = 'SELECT * FROM employees';
      $stm = self::$pdo->prepare($query);
      $stm->execute();

      $employees = $stm->fetchAll(PDO::FETCH_ASSOC);
      return $employees;
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  // Write
  public function registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title)
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

      $success = $stm->execute();

      if ($success) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      return false;
    }
  }

  // Update
  public function updateEmployee($id, $name, $salary, $insurance_id, $status, $location, $job_title)
{
  try {
    // Prepare the SQL query
    $query = 'UPDATE employees SET name = :name, salary = :salary, insurance_id = :insurance_id, status = :status, location = :location, job_title = :job_title WHERE id = :id';
    $stm = self::$pdo->prepare($query);

    // Bind parameters
    $stm->bindParam(':id', $id);
    $stm->bindParam(':name', $name);
    $stm->bindParam(':salary', $salary);
    $stm->bindParam(':insurance_id', $insurance_id);
    $stm->bindParam(':status', $status);
    $stm->bindParam(':location', $location);
    $stm->bindParam(':job_title', $job_title);

    $success = $stm->execute();

    if ($success) {
      return true;
    } else {
      return false; 
    }
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    return false;
  }
}


  // Delete
  public function deleteEmployeeById($id)
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
