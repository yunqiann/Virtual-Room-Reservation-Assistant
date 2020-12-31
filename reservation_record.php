<?php
require_once "Account/google_auth.php";
require_once "Account/config.php";
?>
<!-- <!DOCTYPE html> -->
<!-- <html lang="en"> -->
<html>

<head>
  <title>Virtual Room Reservation Assistant</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-lg">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Virtual Room Reservation Assistant</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <!-- <li class="nav-item active">
            <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="availability.php">Availability</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reservation_record.php">Reservation Record</a>
          </li>
        </ul>
        <span class="navbar-text">
          <?php if (isset($authUrl)) : ?>
            <a href='./login.php'>Login</a>
          <?php else : ?>
            <a href='./Account/logout.php'>Logout</a>
          <?php endif ?>
        </span>
      </div>
    </nav>

    <div class="col-sm-4 col-md-7 col-lg-4 mt-5">
      <table class="table table-bordered table-responsive-sm" id="Availability">
        <thead>
          <tr class="m-0">
            <th>Date</th>
            <th>Time</th>
            <th>Room</th>
            <th>Member1</th>
            <th>Member2</th>
            <th>Member3</th>
            <th>Member4</th>
            <th>Modify</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tr>
            <td>2020/01/01</td>
            <td>09:00~12:00</td>
            <td>B</td>
            <td>a@mail</td>
            <td>b@mail</td>
            <td>c@mail</td>
            <td></td>
            <td>
              <button type="button" class="btn btn-sm btn-secondary">Edit</button>
              <button type="button" class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr> -->

          <?php
          $objDBController = new DBController();
          $records = $objDBController->SearchRecord($userData['email']);
          // die("$records[3][0]");
          foreach ($records as $record) {
            echo "<tr>";
            foreach ($record as $key) {
              echo "<td>$key</td>";
            }
            echo "<td>";
            echo '<button type="button" class="btn btn-sm btn-secondary">Edit</button>';
            echo '<button type="button" class="btn btn-sm btn-danger">Delete</button>';
            echo "</td>";
            echo "</tr>";
          }
          ?>

        </tbody>

      </table>
    </div>
  </div>
</body>

</html>