<?php

require_once dirname(__DIR__) . '/models/manager_model.php';

class ManagerController
{
  private static $managerModel;

  function __construct()
  {
    self::$managerModel = new ManagerModel();
  }
  public function getEmployeeByName($name)
  {
    $response = self::$managerModel->getEmployeeByName($name);
    if ($response) {
      return json_encode($response);
    } else {
      return "Employee not found";
    }
  }

  public function getAllEmployees()
  {
    $response = self::$managerModel->getAllEmployees();
    if ($response) {
      return json_encode($response);
    } else {
      return "No employees found";
    }
  }

  public function registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title)
  {
    $response = self::$managerModel->registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title);
    if ($response) {
      return "Employee registered successfully";
    } else {
      return "Failed to register employee";
    }
  }

  public function updateEmployee($employeeId, $name, $salary, $insurance_id, $status, $location, $job_title)
  {
    $response = self::$managerModel->updateEmployee($employeeId, $name, $salary, $insurance_id, $status, $location, $job_title);
    if ($response) {
      return "Employee data updated successfully";
    } else {
      return "Failed to update employee data";
    }
  } 

  public function deleteEmployeeById($id)
  {
    $response = self::$managerModel->deleteEmployeeById($id);
    if ($response) {
      return "Employee deleted successfully";
    } else {
      return "Failed to delete employee";
    }
  }
}
