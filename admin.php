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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Tasks Details</h2>
                        <a href="views/create_view.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Tasks</a>
                    </div>

                    <?php
                    require_once "config.php";

                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Task</th>";
                                        echo "<th>Action</th>";
                                        echo "<th>Done/ Not Done</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($crow = $res_data->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $crow['id'] . "</td>";
                                        echo "<td>" . $crow['name'] . "</td>";
                                        echo "<td>" . $crow['email'] . "</td>";
                                        echo "<td>" . $crow['task'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="views/read_view.php?id='. $crow['id'] .'" class="mr-3" title="View Task" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="views/update_view.php?id='. $crow['id'] .'" class="mr-3" title="Update Task" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="views/delete_view.php?id='. $crow['id'] .'" title="Delete Task" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";

                                        echo "<td>";
                                        echo '<input type="checkbox">';
                                        echo "</td>";



                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";

                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

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
