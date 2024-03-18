<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <h1 class="fs-3">Dashboard</h1><br>

    <!-- Employees table -->
    <div class="container">
      <h1 class="fs-5">Employees Table</h1><br>
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
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>$2500</td>
            <td>000102</td>
            <td>Hired</td>
            <td>Remote</td>
            <td>Software Developer</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>$2000</td>
            <td>000102</td>
            <td>Hired</td>
            <td>Office</td>
            <td>Software Developer</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry the Bird</td>
            <td>$0</td>
            <td>000102</td>
            <td>Interviewing</td>
            <td>Office</td>
            <td>Software Developer</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>