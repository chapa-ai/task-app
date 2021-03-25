<?php
if(isset($_GET['action'])){
  switch ($_GET['action']) {

         case 'remove_object':
         require 'views/delete_view.php';

         if(isset($_POST["id"]) && !empty($_POST["id"])){
             require_once "config.php";

             $sql = "DELETE FROM tasks WHERE id = ?";

             if($stmt = $mysqli->prepare($sql)){
                 $stmt->bind_param("i", $param_id);

                 $param_id = trim($_POST["id"]);

                 if($stmt->execute()){
                     header("location: view.php");
                     exit();
                 } else{
                     echo "Oops! Something went wrong. Please try again later.";
                 }
             }
             $stmt->close();

             $mysqli->close();
         } else{
             if(empty(trim($_GET["id"]))){
                 header("location: error.php");
                 exit();
        }}
    break;

    case 'read_object':

    require 'views/read_view.php';
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        require_once "config.php";
        $sql = "SELECT * FROM tasks WHERE id = ?";

        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("i", $param_id);

            $param_id = trim($_GET["id"]);

            if($stmt->execute()){
                $result = $stmt->get_result();

                if($result->num_rows == 1){
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    $name = $row["name"];
                    $address = $row["email"];
                    $salary = $row["task"];
                } else{
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        $stmt->close();

        $mysqli->close();
    } else{
        header("location: error.php");
        exit();
    }
    break;

    case 'update_object':

    require 'views/update_view.php';
    require_once "config.php";

    $name = $email = $task = "";
    $name_err = $email_err = $task_err = "";

    if(isset($_POST["id"]) && !empty($_POST["id"])){
        $id = $_POST["id"];

        $input_name = trim($_POST["name"]);
        if(empty($input_name)){
            $name_err = "Please enter a name.";
        } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a valid name.";
        } else{
            $name = $input_name;
        }

        $input_email = trim($_POST["email"]);
        if(empty($input_email)){
            $email_err = "Please enter an email.";
        } else{
            $email = $input_email;
        }

        $input_task = trim($_POST["task"]);
        if(empty($input_task)){
            $salary_err = "Please enter the task amount.";
        }else {
            $task = $input_task;
        }

        if(empty($name_err) && empty($email_err) && empty($task_err)){
            $sql = "UPDATE tasks SET name=?, email=?, task=? WHERE id=?";

            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("sssi", $param_name, $param_email, $param_task, $param_id);

                $param_name = $name;
                $param_email = $email;
                $param_task = $task;
                $param_id = $id;

                if($stmt->execute()){
                    header("location: view.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            $stmt->close();
        }

        $mysqli->close();
    } else{

        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            $id =  trim($_GET["id"]);

            $sql = "SELECT * FROM tasks WHERE id = ?";
            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("i", $param_id);

                $param_id = $id;

                if($stmt->execute()){
                    $result = $stmt->get_result();

                    if($result->num_rows == 1){
                        $row = $result->fetch_array(MYSQLI_ASSOC);

                        $name = $row["name"];
                        $email = $row["email"];
                        $task = $row["task"];
                    } else{
                        header("location: error.php");
                        exit();
                    }

                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }

            $stmt->close();

            $mysqli->close();
        }  else{
            header("location: error.php");
            exit();
        }
    }

}}

?>
