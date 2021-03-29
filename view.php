<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once "config.php";

if (isset($_GET['pageno'])) {

  $pageno = $_GET['pageno'];
} else {

  $pageno = 1;
}

$size_page = 4;

$offset = ($pageno-1) * $size_page;

$count_sql = "SELECT COUNT(*) FROM tasks";

$res = $mysqli->query($count_sql);

$total_rows = $res->fetch_array()[0];

$total_pages = ceil($total_rows / $size_page);

$new_sql = "SELECT * FROM tasks LIMIT $offset, $size_page";

$res_data = $mysqli->query($new_sql);


?>


<body>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort by name
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="all"? " active":"") ?>" href="view.php?page=all">All</a>
    <a class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="anton"? " active":"") ?>" href="view.php?page=anton">Anton</a>
    <a  class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="fedor"? " active":"") ?>" href="view.php?page=fedor">Fedor</a>
  </div>
</div>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort by email
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="all_email"? " active":"") ?>" href="view.php?page=all_email">All</a>
    <a class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="anton_email"? " active":"") ?>" href="view.php?page=anton_email">Anton</a>
    <a  class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="fedor_email"? " active":"") ?>" href="view.php?page=fedor_email">Fedor</a>
  </div>
</div>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort by status
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="0"? " active":"") ?>" href="view.php?page=all_email">0</a>
    <a class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="1"? " active":"") ?>" href="view.php?page=anton_email">1</a>
    <a  class="dropdown-item"  class="nav-link<?php echo($_GET['page']=="2"? " active":"") ?>" href="view.php?page=fedor_email">2</a>
  </div>
</div>


  <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <?php
          if (isset($_GET['page'])){
            switch ($_GET['page']) {

              case 'all':
                $res_data = $mysqli->query("SELECT * FROM tasks");
                include 'new.php';
                break;

             case 'anton':
               $res_data = $mysqli->query("SELECT * FROM tasks WHERE name = 'Anton'");
               include 'new.php';
                break;

              case 'fedor':
                $res_data = $mysqli->query("SELECT * FROM tasks WHERE name = 'Fedor'");
                include 'new.php';
                break;

/* Sort by e-mail below  */

case 'all_email':

  $res_data = $mysqli->query("SELECT * FROM tasks");
  include 'new.php';
break;

case 'anton_email':

  $res_data = $mysqli->query("SELECT * FROM tasks WHERE email = 'anton.chaplygin00@mail.ru'");
  include 'new.php';
break;
?>

<?php
case 'fedor_email':

  $res_data = $mysqli->query("SELECT * FROM tasks WHERE email = 'fedor_iv@gmail.com'");
  include 'new.php';
  break;

  /*  Sort by status below */
  case '0':
    $res_data = $mysqli->query("SELECT * FROM tasks WHERE status = 0");
    include 'new.php';
    break;

 case '1':
   $res_data = $mysqli->query("SELECT * FROM tasks WHERE status = 1");
   include 'new.php';
    break;

  case '2':
    $res_data = $mysqli->query("SELECT * FROM tasks WHERE status = 2");
    include 'new.php';
    break;

      default:
      break;
      }

  }
      ?>
        </main>

    <ul class="pagination" style="position: relative; left: 600px;">
          <li style="position: relative; right: 100px;"><a href="?pageno=1">First</a></li>
          <li style="position: relative; right: 50px;" class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
              <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
          </li>
          <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
              <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
          </li>
          <li style="position: relative; left: 50px;"><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
      </ul>

</body>
</html>
