<?php

session_start();
include('db_connect.php');
include('ClassGateway.php');
selectDB(getConnection());

if(isset($_SESSION['classCodes'])){
    foreach($_SESSION['classCodes'] as $code) {
        $delete = (int)$_POST['delete'];
        if($delete == 1) {
                ClassGateway::deleteClassByClassCode($code);
                unset($_SESSION['classCodes']);
                header( 'Location: courselist.php' );
        }
        else {
                unset($_SESSION['classCodes']);
                header( 'Location: courselist.php' );
        }
    }
}

?>