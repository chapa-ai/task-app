<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
  <div class="mt-5 mb-3 clearfix">
      <h2 class="pull-left">Tasks Details</h2>
      <a href="views/create_view.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Tasks</a>
  </div>

<?php
  echo '<table class="table table-bordered table-striped">';
      echo "<thead>";
          echo "<tr>";
              echo "<th>#</th>";
              echo "<th>Name</th>";
              echo "<th>Email</th>";
              echo "<th>Task</th>";
              echo "<th>Action</th>";

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
                  echo '<a href="views/delete_view.php?id='. $crow['id'] .'" title="Delete Task" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
              echo "</td>";
          echo "</tr>";
      }
      echo "</tbody>";
  echo "</table>";
  ?>
</ul>
</div>
</div>
</div>
</div>
