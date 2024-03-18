<?php

require_once dirname(__DIR__) . '/controllers/manager_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  handleGETRequests();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  handlePOSTRequests();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  handleDELETERequests();
} else {
  http_response_code(405);
  echo 'Method Not Allowed';
}

function handleGETRequests()
{
  if (isset($_GET['action'])) {
    switch ($_GET['action']) {
      case 'getEmployeeByName':
        if (isset($_GET['name'])) {
          $name = $_GET['name'];
          echo json_encode(ManagerController::getEmployeeByName($name));
        } else {
          echo 'Name parameter is missing.';
        }
        break;

      case 'getAllEmployees':
        echo json_encode(ManagerController::getAllEmployees());
        break;

      default:
        http_response_code(404);
        echo 'Invalid action.';
        break;
    }
  } else {
    http_response_code(404);
    echo 'Action parameter is missing.';
  }
}

function handlePOSTRequests()
{
  if (isset($_POST['action'])) {
    switch ($_POST['action']) {
      case 'registerNewEmployee':
        if (isset($_POST['name'], $_POST['salary'], $_POST['insurance_id'], $_POST['status'], $_POST['location'], $_POST['job_title'])) {
          $name = $_POST['name'];
          $salary = $_POST['salary'];
          $insurance_id = $_POST['insurance_id'];
          $status = $_POST['status'];
          $location = $_POST['location'];
          $job_title = $_POST['job_title'];
          echo ManagerController::registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title);
        } else {
          echo 'Required parameters are missing.';
        }
        break;

      default:
        http_response_code(404);
        echo 'Invalid action.';
        break;
    }
  } else {
    http_response_code(404);
    echo 'Action parameter is missing.';
  }
}

function handleDELETERequests()
{
  parse_str(file_get_contents('php://input'), $delete_vars);
  if (isset($delete_vars['action'])) {

    switch ($delete_vars['action']) {
      case 'deleteEmployeeById':

        if (isset($delete_vars['id'])) {
          $id = $delete_vars['id'];
          echo ManagerController::deleteEmployeeById($id);
        } else {
          echo 'ID parameter is missing.';
        }
        break;

      default:
        http_response_code(404);
        echo 'Invalid action.';
        break;
    }
  } else {
    http_response_code(404);
    echo 'Action parameter is missing.';
  }
}
