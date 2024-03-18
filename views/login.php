<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Login</title>
  <style>
    .form {
      min-height: 90vh;
      margin: auto;
    }

    body {
      overflow-x: hidden;
    }
  </style>
</head>

<body>
  <div class="form row justify-content-center align-items-center">
    <div class="col-md-4">
      <h1 class="text-center">Login</h1>

      <form action="/routers/login_router.php" method="POST">

        <label for="name" class="form-label">Name:</label>
        <input class="form-control" type="text" id="name" name="name"><br>

        <label for="password" class="form-label">Password:</label>
        <input class="form-control" type="password" id="password" name="password"><br>

        <button type="submit" class="btn btn-success col-md-6">Submit</button>
      </form>
    </div>
  </div>
</body>

</html>