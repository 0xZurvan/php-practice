<?php

require_once dirname(__DIR__) . '/models/manager_model.php';

class ManagerController
{
  public static function getEmployeeByName($name)
  {
    $response = ManagerModel::getEmployeeByName($name);
    if ($response) {
      return $response;
    } else {
      return "Employee not found";
    }
  }

  public static function getAllEmployees()
  {
    $response = ManagerModel::getAllEmployees();
    if ($response) {
      return $response;
    } else {
      return "No employees found";
    }
  }

  public static function registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title)
  {
    $response = ManagerModel::registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title);
    if ($response) {
      return "Employee registered successfully";
    } else {
      return "Failed to register employee";
    }
  }

  public static function deleteEmployeeById($id)
  {
    $response = ManagerModel::deleteEmployeeById($id);
    if ($response) {
      return "Employee deleted successfully";
    } else {
      return "Failed to delete employee";
    }
  }
}
