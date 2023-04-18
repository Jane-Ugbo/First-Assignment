<?php
if(isset($_POST['title'])){
    require '../db_connect.php';
    $title = $_POST['title'];
    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $connect->prepare("INSERT INTO todo(title) VALUE(?)");
        $res = $stmt->execute([$title]);
        if($res){
            header("Location: ../index.php?mess=success");
        }else {
            header("Location: ../index.php");
        }
        $connect = null;
        exist();
    }
}else {
    header("Location: ../index.php?mess=error");
}
