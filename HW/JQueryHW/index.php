<?php
    $arr = array('username'=>$_POST['username'], 'firstName'=>$_POST['fname']);
    echo json_encode($arr);
?>