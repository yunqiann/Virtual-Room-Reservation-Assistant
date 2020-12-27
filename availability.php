<?php require_once "Account/google_auth.php"; ?>
<!-- <!DOCTYPE html> -->
<!-- <html lang="en"> -->
<html>

<head>
  <meta charset="UTF-8">
  <title>Virtual Room Reservation Assistant</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/myCSS.css">

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
      <!-- Modal HTML Markup -->
      <div id="myModal" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title">Meeting Information</h1>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" action="">
                <input type="hidden" name="_token" value="">
                <div class="form-group">
                  <label class="control-label">Date: <span id="date"></span></label>
                </div>
                <div class="form-group">
                  <label class="control-label">Time:<br><span id="time"></span></label>
                  <input type="member-email" class="from-control input-sm" name="time" value=<span id="time"></span> readonly="readonly">
                </div>
                <div class="form-group">
                  <label class="control-label">Room: <span id="room"></span></label>
                </div>
                <div class="form-group">
                  <label class="control-label">Host(Email Address)</label>
                  <input type="host-email" class="form-control input-sm" name="host-email" value=<?php echo $userData["email"]; ?> readonly="readonly" />
                </div>
                <div class="form-group">
                  <label class="control-label">Member(Email Addresses)</label>
                  <input type="member-email" class="form-control input-sm" name="member-email1"><br>
                  <input type="member-email" class="form-control input-sm" name="member-email2"><br>
                  <input type="member-email" class="form-control input-sm" name="member-email3"><br>
                  <input type="member-email" class="form-control input-sm" name="member-email4"><br>
                </div>
                <div class="form-group">
                  <div>
                    <button type="submit" class="btn btn-success">Sava</button>
                    <button type="cancel" class="btn btn-secondary">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <table class="table table-bordered table-responsive-sm" id="Availability">
        <thead>
          <tr class="m-0">
            <th>#</th>
            <th>A</th>
            <th>B</th>
            <th>C</th>
            <th>D</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>08:00-09:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>09:00-10:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>10:00-11:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>11:00-12:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>12:00-13:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>13:00-14:00</th>
            <td></td>
            <!-- <td class="not_available"></td> -->
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>14:00-15:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>15:00-16:00</th>
            <td></td>
            <td></td>
            <!-- <td class="not_available"></td> -->
            <td></td>
          </tr>
          <tr>
            <th>16:00-17:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>

      </table>
    </div>
  </div>
  <button type="button" class="btn btn-primary" onclick="confirmTimeSlot()">Sumbit</button>
  <button type="button" class="btn btn-secondary" onclick="clearSelected()">Clear</button>



</body>

</html>

<script src="./javascript/availability.js"></script>

<!-- Optional JavaScript for bootstrap -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>