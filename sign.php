<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

require "config.php";

$status = 0;

if(isset($_POST['login']) && isset($_POST['password'])){

  $sql = "SELECT * FROM signin WHERE login='".$_POST['login']."'";
  $result = $mysqli->query($sql);

  $res = $result->fetch_array();
  if($res == false){
    $status = 1;
  }else{
    if($_POST['password'] == $res['password']){
      $_SESSION['user'] = $res;
      header("Location: admin.php");
    }else{
      $status = 2;
    } } }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sign in</title>
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
