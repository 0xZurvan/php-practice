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
    $managerController = new ManagerController();
    switch ($_GET['action']) {
      case 'getEmployeeByName':
        if (isset($_GET['name'])) {
          $name = $_GET['name'];
          echo $managerController->getEmployeeByName($name);
        } else {
          echo 'Name parameter is missing.';
        }
        break;

      case 'getAllEmployees':
        echo $managerController->getAllEmployees();
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
  $managerController = new ManagerController();
  switch ($_GET['action']) {
    case 'registerNewEmployee':
      if (isset($_POST['name'], $_POST['salary'], $_POST['insurance_id'], $_POST['status'], $_POST['location'], $_POST['job_title'])) {
        $name = $_POST['name'];
        $salary = $_POST['salary'];
        $insurance_id = $_POST['insurance_id'];
        $status = $_POST['status'];
        $location = $_POST['location'];
        $job_title = $_POST['job_title'];

        echo $managerController->registerNewEmployee($name, $salary, $insurance_id, $status, $location, $job_title);
      } else {
        echo 'Required parameters to register are missing.';
      }
      break;

    case 'updateEmployee':
      if (isset($_POST['id'], $_POST['name'], $_POST['salary'], $_POST['insurance_id'], $_POST['status'], $_POST['location'], $_POST['job_title'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $salary = $_POST['salary'];
        $insurance_id = $_POST['insurance_id'];
        $status = $_POST['status'];
        $location = $_POST['location'];
        $job_title = $_POST['job_title'];

        echo $managerController->updateEmployee($id, $name, $salary, $insurance_id, $status, $location, $job_title);
      } else {
        echo 'Required parameters to update are missing.';
      }
      break;

    default:
      http_response_code(404);
      echo 'Invalid action.';
      break;
  }
}


function handleDELETERequests()
{
  $input_data = file_get_contents('php://input');
  $id = json_decode($input_data, true);
  $managerController = new ManagerController();

  switch ($_GET['action']) {
    case 'deleteEmployeeById':
      if (isset($id)) {
        echo $managerController->deleteEmployeeById($id);
      } else {
        http_response_code(400);
        echo 'ID parameter is missing.';
      }
      break;

    default:
      http_response_code(404);
      echo 'Invalid action.';
      break;
  }
}
