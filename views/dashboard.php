<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <title>Dashboard</title>
  <style>
    .main {
      margin: 20px;
    }
  </style>
</head>

<body>
  <div class="row justify-content-around gap-4 main">
    <!-- Nav -->
    <div class="d-flex flex-row justify-content-between">
      <h2 class="fs-5">Logo</h2>
      <button onclick="redirectToLogin()" class="btn btn-primary">Login</button>
    </div>

    <div class="d-flex flex-row gap-4">
      <h1 class="fs-3">Dashboard</h1>
      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewEmployeeModal">Add new employee</button>
    </div>

    <!-- Employees table -->
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Salary</th>
            <th scope="col">Insurance ID</th>
            <th scope="col">Status</th>
            <th scope="col">Location</th>
            <th scope="col">Job Title</th>
            <th scope="col"></th> <!-- update -->
            <th scope="col"></th> <!-- remove -->
          </tr>
        </thead>
        <tbody id="employeesTable">
        </tbody>
      </table>
    </div>

    <!-- Add New Employee Modal -->
    <div class="modal fade" id="addNewEmployeeModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalLabel">Add new employee</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addNewEmployeeModalForm" class="was-validated" onsubmit="submitModalForm(event)">

              <label for="name" class="form-label">Name:</label>
              <input class="form-control" type="text" id="name" name="name" required><br>

              <label for="salary" class="form-label">Salary:</label>
              <input class="form-control" type="number" id="salary" name="salary" required><br>

              <label for="insurance_id" class="form-label">Insurance ID:</label>
              <input class="form-control" type="number" id="insurance_id" name="insurance_id" required><br>

              <select id="status" name="status" class="form-select" aria-label="Select employee status" required>
                <option selected disabled value="">Select employee status</option>
                <option value="Hired">Hired</option>
                <option value="Interviewing">Interviewing</option>
                <option value="Fired">Fired</option>
              </select><br>

              <select id="location" name="location" class="form-select" aria-label="Select working location" required>
                <option selected disabled value="">Select working location</option>
                <option value="Office">Office</option>
                <option value="Remote">Remote</option>
              </select><br>

              <label for="job_title" class="form-label">Job Title:</label>
              <input class="form-control" type="text" id="job_title" name="job_title" required><br>

              <button class="btn btn-success col-md-6" data-bs-dismiss="modal" aria-label="Close">Submit</button>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Update Employee Modal -->
    <div class="modal fade" id="updateEmployeeModal" name="updateEmployeeModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalLabel">Update employee</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="updateEmployeeModalForm" class="was-validated" onsubmit="submitUpdateModalForm(event)">

              <input type="hidden" id="id" name="id">

              <label for="name" class="form-label">Name:</label>
              <input class="form-control" type="text" id="update_name" name="name" required><br>

              <label for="salary" class="form-label">Salary:</label>
              <input class="form-control" type="number" id="update_salary" name="salary" required><br>

              <label for="insurance_id" class="form-label">Insurance ID:</label>
              <input class="form-control" type="number" id="update_insurance_id" name="insurance_id" required><br>

              <select id="update_status" name="status" class="form-select" aria-label="Select employee status" required>
                <option selected disabled value="">Select employee status</option>
                <option value="Hired">Hired</option>
                <option value="Interviewing">Interviewing</option>
                <option value="Fired">Fired</option>
              </select><br>

              <select id="update_location" name="location" class="form-select" aria-label="Select working location" required>
                <option selected disabled value="">Select working location</option>
                <option value="Office">Office</option>
                <option value="Remote">Remote</option>
              </select><br>

              <label for="job_title" class="form-label">Job Title:</label>
              <input class="form-control" type="text" id="update_job_title" name="job_title" required><br>

              <button class="btn btn-success col-md-6" data-bs-dismiss="modal" aria-label="Close">Submit</button>

            </form>
          </div>
        </div>
      </div>
    </div>


  </div>

  <script>
    document.addEventListener("DOMContentLoaded", async function() {
      await fetchEmployeesData()
    })

    function resetForm(formId) {
      const form = document.getElementById(formId);
      form.reset();
    }

    async function fetchEmployeesData() {
      await fetch('/routers/manager_router.php?action=getAllEmployees', {
          method: 'GET'
        })
        .then(response => response.json())
        .then(employees => {
          const tableBody = document.getElementById('employeesTable')
          tableBody.innerHTML = '';
          employees.forEach(employee => {
            const row = document.createElement('tr')
            row.innerHTML = `
                <td>${employee.id}</td>
                <td>${employee.name}</td>
                <td>$ ${employee.salary}</td>
                <td>${employee.insurance_id}</td>
                <td>${employee.status}</td>
                <td>${employee.location}</td>
                <td>${employee.job_title}</td>
                <td><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#updateEmployeeModal" onclick="openUpdateModal(${employee.id})">Update</button></td>
                <td><button type="button" class="btn btn-danger" onclick="removeEmployeeById(${employee.id})">Remove</button></td>
              `;
            tableBody.appendChild(row)
          });
        })
        .catch(error => console.error('Error fetching employees data:', error))
    }

    function openUpdateModal(employeeId) {
      document.getElementById('id').value = employeeId;
    }


    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      const bootstrapModal = new bootstrap.Modal(modal);
      bootstrapModal.hide();
    }

    async function submitModalForm(event) {
      event.preventDefault()
      const modalForm = document.getElementById('addNewEmployeeModalForm')
      const formData = new FormData(modalForm)

      await fetch('/routers/manager_router.php?action=registerNewEmployee', {
        method: 'POST',
        body: formData
      }).then(async () => {
        await fetchEmployeesData()
        closeModal('addNewEmployeeModal')
        resetForm('addNewEmployeeModalForm');
      }).catch(error => console.error('Error registering new employee:', error));
    }

    async function submitUpdateModalForm(event) {
      event.preventDefault();
      const updateModalForm = document.getElementById('updateEmployeeModalForm');
      const formData = new FormData(updateModalForm);
      formData.append('id', document.getElementById('id').value);

      await fetch('/routers/manager_router.php?action=updateEmployee', {
          method: 'POST',
          body: formData
        })
        .then(async (response) => {
          if (response.ok) {
            await fetchEmployeesData()
            closeModal('updateEmployeeModal');
            resetForm('updateEmployeeModalForm');
          }
        })
        .catch(error => console.error('Error updating employee data:', error));
    }

    async function removeEmployeeById(employeeId) {
      await fetch('/routers/manager_router.php?action=deleteEmployeeById', {
          method: 'DELETE',
          body: employeeId
        })
        .then(async (response) => {
          if (response.ok) {
            await fetchEmployeesData()
          }
        })
        .catch(error => console.error('Error removing employee:', error));
    }
  </script>
</body>

</html>