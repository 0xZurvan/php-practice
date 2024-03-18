<?php

require_once dirname(__DIR__) . '/models/manager_model.php';

class ManagerController
{
  private static $managerModel;

  function __construct()
  {
    self::$managerModel = new ManagerModel();
  }
  public static function getEmployeeByName($name)
  {
    $response = self::$managerModel->getEmployeeByName($name);
    if ($response) {
      return json_encode($response);
    } else {
      return "Employee not found";
    }
  }

  public static function getAllEmployees()
  {
    $response = self::$managerModel->getAllEmployees();
    if ($response) {
      return json_encode($response);
    } else {
      return "No employees found";
    }
  }

  public static function registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title)
  {
    $response = self::$managerModel->registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title);
    if ($response) {
      return "Employee registered successfully";
    } else {
      return "Failed to register employee";
    }
  }

  public static function deleteEmployeeById($id)
  {
    $response = self::$managerModel->deleteEmployeeById($id);
    if ($response) {
      return "Employee deleted successfully";
    } else {
      return "Failed to delete employee";
    }
  }
}
