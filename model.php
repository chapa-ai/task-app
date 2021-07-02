<?php
require_once 'config.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);

class Model {

  public $mysqli;

  public function __construct() {
    global $mysqli;
    $this->mysqli = $mysqli;
  }

  public function status($status_id) {

    $status = "SELECT * FROM tasks WHERE status =".intval($status_id);
    $result = $this->mysqli->query($status);

    $res = NULL;
    if($result) {
    $res = $result->fetch_all(MYSQLI_ASSOC);
    }
    return $res;
  }

  public function name($name) {
    $sql_name = "SELECT * FROM tasks";


    if($name !='all') {
       $sql_name .= " WHERE name ='".$name."'";
    }
    $result = $this->mysqli->query($sql_name);

    $res = [];
    if($result) {
    $res = $result->fetch_all(MYSQLI_ASSOC);
    }
    return $res;
  }

  public function email($email) {
    $sql_email = "SELECT * FROM tasks";

    if($email !='all') {
       $sql_email .= " WHERE email ='".$email."'";
    }
    $result = $this->mysqli->query($sql_email);

    $res = [];
    if($result) {
    $res = $result->fetch_all(MYSQLI_ASSOC);
    }
    return $res;
  }

  public function read_object() {
    $sql = "SELECT * FROM tasks WHERE id=?";

    if($stmt = $this->mysqli->prepare($sql)){

        $stmt->bind_param("i", $param_id);

        $param_id = trim($_GET["id"]);

        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows == 1){
                $crow = $result->fetch_array(MYSQLI_ASSOC);
        } } } } }


?>
