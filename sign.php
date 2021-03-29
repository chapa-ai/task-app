<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

require "config.php";

$status = 0;

//if($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['login']) && isset($_POST['password'])){

  $sql = "SELECT * FROM signin WHERE login = ' ".$_POST['login']."'";
  $result = $mysqli->query($sql);

  var_dump($result);

  while($res = $result->fetch_array()) {
  if($res == false){
    $status = 1;
  }else{
    if($_POST['password'] == $res['password']){
      $_SESSION['user'] = $res;
      header("Location: admin.php");
    }else{
      $status = 2;
    }
  }
} }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mapservice</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sign.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
      <?php
      switch($status){
        case 1:
          ?><div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-warning-sign"></span> <strong>Error:</strong> Login/password are incorrect
            </div>
          <?php
          break;
        case 2:
          ?><div class="alert alert-warning" role="alert">
              <span class="glyphicon glyphicon-warning-sign"></span> <strong>Error:</strong> Login/password are incorrect
            </div>
          <?php
          break;
      }
    ?>
  <body>
    <div class="container">
      <form class="form-signin" action="sign.php" method="post">
        <label for="inputLogin" class="sr-only">Login</label>
        <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Login" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
  </body>
</html>
