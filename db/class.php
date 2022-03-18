<?php
require('db/dbconfig.php');
    $sno = $_SESSION[login];
    $q = "SELECT `username` FROM `user` WHERE `sno` = '$sno'";
    $ret = mysqli_query($con, $q);
    while($row_=mysqli_fetch_array($ret)){
        $uname = $row_['username'];   
        $_SESSION['regno'] = $row_['username'];                                         
        $query=mysqli_query($con,"SELECT `class` from student WHERE `reg_no` = '$uname'");                                               
        while($row=mysqli_fetch_array($query)){
            $_SESSION['class'] = $row['class'];
        }
    }
?>