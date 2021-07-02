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

require_once "model.php";

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
    <a class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page']) and $_GET['page'] == "all"? " active":"") ?>" href="view.php?page=filter_by_name&name=all">All</a>
    <a class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page'])=="anton"? " active":"") ?>" href="view.php?page=filter_by_name&name=anton">Anton</a>
    <a  class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page'])=="fedor"? " active":"") ?>" href="view.php?page=filter_by_name&name=fedor">Fedor</a>
  </div>
</div>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort by email
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page'])=="all_email"? " active":"") ?>" href="view.php?page=filter_by_email&email=all">All</a>
    <a class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page'])=="anton_email"? " active":"") ?>" href="view.php?page=filter_by_email&email=anton.chaplygin00@mail.ru">Anton</a>
    <a  class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page'])=="fedor_email"? " active":"") ?>" href="view.php?page=filter_by_email&email=fedor_iv@gmail.com">Fedor</a>
  </div>
</div>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort by status
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <a class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page'])=="0"? " active":"") ?>" href="view.php?page=filter_by_status&status=0">0</a>
   <a class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page'])=="1"? " active":"") ?>" href="view.php?page=filter_by_status&status=1">1</a>
   <a class="dropdown-item"  class="nav-link<?php echo(isset($_GET['page'])=="2"? " active":"") ?>" href="view.php?page=filter_by_status&status=2">2</a>

  </div>
</div>

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
 <?php
  if (isset($_GET['page'])){
   $db = new Model();

   switch ($_GET['page']) {

      /*  Sort by status below */
      case 'filter_by_status':
       $res_data = $db->status($_GET['status']);
      break;

      case 'filter_by_name':
       $res_data = $db->name($_GET['name']);
      break;

      case 'filter_by_email':
       $res_data = $db->email($_GET['email']);
      break;

      case 'read_object':
      $res_data = $db->read_object();
      break;

     default:
     break;
}   }

include 'front.php';
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
