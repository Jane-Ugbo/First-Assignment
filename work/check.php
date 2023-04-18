<?php
if(isset($_POST['id'])){
    require '../db_connect.php';
    $id = $_POST['id'];
    if(empty($id)){
        echo error;
    }else {
        $todo = $connect->prepare("SELECT id, checked FROM todo WHERE id=?");
        $todo->execute([$id]);
        
        $todos = $todo->fetch();
        $uid = $todos['id'];
        $checked = $todos['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $connect->query("UPDATE todo SET checked=$uChecked WHERE id=$uId");
        if($res){
            echo $checked;
        }else {
            echo "error";
        }
        $connect = null;
        exist();
    }
}else {
    header("Location: ../index.php?mess=error");
}
