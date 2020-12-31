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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
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
            <th style="min-width:120px">Time</th>
            <th>Room</th>
            <th>Member1</th>
            <th>Member2</th>
            <th>Member3</th>
            <th>Member4</th>
            <th>Modify</th>
          </tr>
        </thead>
        <tbody>
          <!-- <from action="Record/modify.php" method="post">
            <tr>
              <td name="date">2020/01/01</td>
              <td name="">09:00~12:00</td>
              <td name="room">B</td>
              <td>a@mail</td>
              <td>b@mail</td>
              <td>c@mail</td>
              <td></td>
              <td>
                <button type="button" class="btn btn-sm btn-secondary">Edit</button>
                <button type="button" class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          </from> -->

          <?php
          $objDBController = new DBController();
          $records = $objDBController->SearchRecord($userData['email']);

          foreach ($records as $record) {
          ?>
            <form action="Record/delete.php" method="post">
              <tr>
                <td>
                  <?php echo $record[0]; ?>
                  <input type="hidden" name="date" value="<?php echo $record[0]; ?>">
                </td>
                <td>
                  <input type="hidden" name="time" value="<?php echo $record[1]; ?>">
                  <?php
                  switch ($record[1]) {
                    case '1':
                      echo "08:00-09:00";
                      break;
                    case '2':
                      echo "09:00-10:00";
                      break;
                    case '3':
                      echo "10:00-11:00";
                      break;
                    case '4':
                      echo "11:00-12:00";
                      break;
                    case '5':
                      echo "12:00-13:00";
                      break;
                    case '6':
                      echo "13:00-14:00";
                      break;
                    case '7':
                      echo "14:00-15:00";
                      break;
                    case '8':
                      echo "15:00-16:00";
                      break;
                    case '9':
                      echo "16:00-17:00";
                      break;
                  }
                  ?>
                </td>
                <td>
                  <?php echo $record[2]; ?>
                  <input type="hidden" name="room" value="<?php echo $record[2]; ?>">
                </td>
                <td><?php echo $record[3]; ?></td>
                <td><?php echo $record[4]; ?></td>
                <td><?php echo $record[5]; ?></td>
                <td><?php echo $record[6]; ?></td>
                <td>
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </td>
              </tr>
            </form>
          <?php
          }

          // die("$records[3][0]");
          // foreach ($records as $record) {
          //   echo "<tr>";
          // foreach ($record as $key) {
          //   switch ($key) {
          //     case '1':
          //       $key = "08:00-09:00";
          //       break;
          //     case '2':
          //       $key = "09:00-10:00";
          //       break;
          //     case '3':
          //       $key = "10:00-11:00";
          //       break;
          //     case '4':
          //       $key = "11:00-12:00";
          //       break;
          //     case '5':
          //       $key = "12:00-13:00";
          //       break;
          //     case '6':
          //       $key = "13:00-14:00";
          //       break;
          //     case '7':
          //       $key = "14:00-15:00";
          //       break;
          //     case '8':
          //       $key = "15:00-16:00";
          //       break;
          //     case '9':
          //       $key = "16:00-17:00";
          //       break;
          //   }
          // echo "<td>$key</td>";
          //   }
          //   echo "<td>";
          //   echo '<button type="button" class="btn btn-sm btn-secondary">Edit</button>';
          //   echo '<button type="button" class="btn btn-sm btn-danger">Delete</button>';
          //   echo "</td>";
          //   echo "</tr>";
          // }
          ?>

        </tbody>

      </table>
    </div>
  </div>
</body>

</html>