<?php
require_once "Account/google_auth.php";
require_once "Account/config.php";

date_default_timezone_set('Asia/Taipei');
$selectDateStr = $_POST['selectDate'] ? $_POST['selectDate'] : '';

if (!isset($selectDate)) {
  $selectDate = date_create($selectDateStr);
  $today = date("Y-m-d");
  if ($selectDateStr < $today) {
    header("Location: index.php");
  }
}

?>

<!-- <!DOCTYPE html> -->
<!-- <html lang="en"> -->
<html>

<head>
  <title>Virtual Room Reservation Assistant</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./css/all.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script> -->
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
          <!-- <li class="nav-item">
            <a class="nav-link" href="availability.php">Availability</a>
          </li> -->
          <?php if (!isset($authUrl)) : ?>
            <li class="nav-item">
              <a class="nav-link" href="reservation_record.php">Reservation Record</a>
            </li>
          <?php endif ?>
          <!-- <li class="nav-item">
            <a class="nav-link" href="reservation_record.php">Reservation Record</a>
          </li> -->
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
    <!-- <h4>The date you choose is</h4> -->
    <!-- <p id="selected_date"></p> -->
    <div style="text-align:center;">
      <h2><br>Selected date: <?php echo ("$selectDateStr"); ?></h2>
    </div>
    <div class="col-sm-4 col-md-7 col-lg-4 mt-5">
      <div id="myModal" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title">Meeting Information</h1>
            </div>
            <div class="modal-body">
              <form>
                <!-- <input type="hidden" name="_token" value=""> -->
                <div class="form-group">
                  <label class="control-label">Date: <br><span id="selected_date" name="selected_date"></span></label>
                </div>
                <div class="form-group">
                  <label class="control-label">Time: <br><span id="time"></span></label>
                  <!-- <label type=hidden><span id="timeSlot"></span></label> -->
                </div>
                <div class="form-group">
                  <label class="control-label">Room: <br><span id="room"></span></label>
                </div>
                <div class="form-group">
                  <label class="control-label">Host(Email Address):</label><br>
                  <input size="35" id="host-email" value=<?php echo $userData["email"]; ?> readonly="readonly" />
                </div>
                <div class="form-group">
                  <label class="control-label">Member(Email Addresses):</label>
                  <input type="member-email" size="35" id="member-email1" ><br><br>
                  <input type="member-email" size="35" id="member-email2"><br><br>
                  <input type="member-email" size="35" id="member-email3"><br><br>
                  <input type="member-email" size="35" id="member-email4"><br><br>
                </div>
                <div class="form-group">
                  <div>
                    <button type="submit" class="btn btn-success" id="save">Save</button>
                    <button type="cancel" class="btn btn-secondary">Cancel</button>
                  </div>
                </div>
              </form>

              <script>
                $(function() {
                  $("#save").click(function() {
                    // console.log(formatDate($("#selected_date").html()))

                    $.ajax({
                      type: "POST",
                      url: "Record/insert.php",
                      dataType: "JSON",
                      data: {
                        // date: $("#selected_date").html(),
                        date: formatDate($("#selected_date").html()),
                        time: getTimeSlotArray(),
                        room: $("#room").html(),
                        email: $("#host-email").val(),
                        member1: $("#member-email1").val(),
                        member2: $("#member-email2").val(),
                        member3: $("#member-email3").val(),
                        member4: $("#member-email4").val()
                      },
                      success: function(data) {
                        console.log("ok");
                        var date = data.date;
                        var time = data.time;
                        var room = data.room;
                        var email = data.email;
                        var member1 = data.member1;
                        var member2 = data.member2;
                        var member3 = data.member3;
                        var member4 = data.member4;
                        var result = "Date: " + date + ", Time: " + time + ", Room: " + room + ", Email: " + email +
                          ", Member1: " + member1 + ", Member2: " + member2 + ", Member3: " + member3 +
                          ", Member4: " + member4;
                        console.log(result);
                        window.location = "./reservation_record.php";
                        // var sql = "INSERT INTO Record VALUES ('" + date + "','" + time + "','" + email + "','" + room +
                        // "','" + member1 + "','" + member2 + "','" + member3 + "','" + member4 + "')";
                        // console.log(sql);
                        // $("#result").html(result);
                      },
                      error: function(xhr) {
                        console.log(xhr.status);
                        window.location = "./reservation_record.php";
                      }   
                    });
                  });
                  return false;
                });
              </script>
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
          <?php
          $timeStr = array(
            "08:00-09:00", "09:00-10:00", "10:00-11:00", "11:00-12:00", "12:00-13:00",
            "13:00-14:00", "14:00-15:00", "15:00-16:00", "16:00-17:00"
          );
          $roomStr = array("A", "B", "C", "D");
          $objDBController = new DBController();
          $recordData = new stdClass();
          $recordData->date = $selectDateStr;
          // $recordData->date = gettype($recordData->date);
          for ($i = 0; $i < 9; $i++) {  //Room
            $recordData->time = $i;
            // $recordData->time = gettype($recordData->time);
          ?>
            <tr>
              <th><?php echo $timeStr[$i]; ?></th>
              <?php
              for ($j = 0; $j < 4; $j++) {
                $recordData->room = $roomStr[$j];
                // $recordData->room = gettype($recordData->room);
                $use = $objDBController->SearchRoomTime($recordData);
                // $ues = gettype($use);
                if ($use === '1') { ?>
                  <td class="not_available"></td>
                <?php } else { ?>
                  <td></td>
              <?php }
              }
              ?>
            </tr>
          <?php
          }
          ?>
          <!-- <tr>
            <th value>08:00-09:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>09:00-10:00</th>
            <td class=not_available></td>
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
            <td></td>
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
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>16:00-17:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td> -->
          </tr>
        </tbody>

      </table>

    </div>
  </div>
  <!-- <div id="result"></div> -->
  <div style="text-align:center;">
    <?php if (isset($authUrl)) : ?>
      <h1>After logging in, you can reserve a room.</h1>
    <?php else : ?>
      <button id="submit" type="button" class="submit" onclick="confirmTimeSlot()">Sumbit</button>
      <button type="button" class="clear" onclick="clearSelected()">Clear</button>
    <?php endif ?>
  </div>
</body>

</html>
<script src="./javascript/availability.js"></script>