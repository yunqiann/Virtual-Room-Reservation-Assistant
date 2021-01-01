<?php require_once "Account/google_auth.php"; ?>

<html>

<head>
  <meta charset="UTF-8">
  <title>Virtual Room Reservation Assistant</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="css/myCSS.css">
  <link rel="stylesheet" type="text/css" href="css/login.css" />
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
  </div>

  <div class="container col-sm-4 col-md-7 col-lg-4 mt-5">
    <div class="heading">
      <h2>Google OAuth 2.0 Login</h2>
    </div>
    <div class="box">
      <div>
        <!-- Show Login if the OAuth Request URL is set -->
        <?php if (isset($authUrl)) : ?>
          <!-- <img src="images/user.png" width="100px" size="100px" /><br /> -->
          <a class='login' href='<?php echo $authUrl; ?>'><img class='login' src="images/sign-in-with-google.png" width="250px" size="54px" /></a>
          <!-- Show User Profile otherwise-->
        <?php else : ?>
          <br><br>
          <img class="circle-image" src="<?php echo $userData["picture"]; ?>" width="200px" size="200px" /><br />
          <br><p class="welcome">Welcome</p><br>
          <p class="oauthemail"><?php echo $userData["name"]; ?> </p>
          <p class="oauthemail"><?php echo $userData["email"];?></p>
          <?php header("Location: index.php"); ?>
          <!-- <div class='logout'><a href='./logout.php'>Logout</a></div> -->
        <?php endif ?>
      </div>
    </div>
  </div>
</body>

</html>