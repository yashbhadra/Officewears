<?php
require_once "config.php";
$id = $_POST['id'];

$check_if_exists = mysqli_query($link,"SELECT * FROM User WHERE User_id='$id'");
$row = mysqli_num_rows($check_if_exists);
if($row > 0){
    $sql = "DELETE FROM User WHERE User_id='$id';";
    $result = mysqli_query($link,$sql);
    if($result){
        echo 1;
        exit;
    }
}
echo 0;
exit;

?>