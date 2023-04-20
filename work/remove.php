<?php
if(isset($_POST['id'])){
    require '../db_connect.php';
    $id = $_POST['id'];
    if(empty($id)){
        echo 0;
    }else {
        $stmt = $connect->prepare("DELETE FROM todo WHERE id=?");
        $res = $stmt->execute([$id]);
        if($res){
           echo 1;
        }else {
          echo 0;
        }
        $connect = null;
        exist();
    }
}else {
    header("Location: ../index.php?mess=error");
}
