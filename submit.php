<?php 
    session_start();
    require('db/dbconfig.php');
    require('db/class.php');
    require("api/sms.php");
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $regno = $_SESSION['regno'];
        $comment = $_POST['comment'];
        $taskid = $_GET['taskid'];
        $sql = "INSERT INTO `submission` ( `taskid`, `reg_no`, `comment`) VALUES ( '$taskid', '$regno', '$comment');";
        // $query = "INSERT INTO `task` ( `type`, `urgency`, `class`, `decsr`, `trainer`) VALUES ('$type', '$urgency', '$class', '$descr', '$emp_no')";                
        if($con->query($sql)){
            $recipients = array();
            $recipientsQuery = "select `telephone` from `trainer`, `task`, submission WHERE `task`.`trainer` = `trainer`.`emp_no` AND `task`.`id` = `submission`.`taskid` AND `task`.`id` = '$taskid'";
            $res = mysqli_query($con, $recipientsQuery) or die(mysql_error());

            $message = 'New submission by ' .$regno. '. Comment: '.$comment;
            $from = "SIST Academic progress";

            while ($row = mysqli_fetch_assoc($res)) {
                $recipient = $row["telephone"];                 
                try {
                    $result = $sms->send([
                    'to'      => $recipient,
                    'message' => $message,
                    // 'from'    => $from
                    ]);
                    print_r($result);
                } catch (Exception $e) { 
                    echo "Error: ".$e->getMessage();     
                }
            }
            header("location:index.php");   
        }    
           
}
// $AT.sendMessage($recipients, $message);
     
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "./includes/header.html" ?>
    <body class="sb-nav-fixed">
        <?php include "./includes/topnav.html" ?>
        <?php include "./includes/sidenav.html" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h2>Submission page</h2>
                        <br>                                                                                                     
                        <?php 
                         $id = $_GET['taskid'];                                
                         // $con = $conn;
                         $query = "SELECT * FROM task WHERE `id` = '$id'";
                         $ret = mysqli_query($con, $query);
                         while ($row=mysqli_fetch_array($ret)) { ?>                                                                                                                                                                                                       
                             <form method="POST">
                                <h4>Initial Instructions</h4>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" name="instructions" type="text" placeholder="Enter your registra" required value="<?php  echo $row['descr'];?>" />
                                    <label for="inputEmail">Initial instructions</label>
                                </div>
                                <h4>Content type</h4>
                                <div class="form-floating mb-3">   
                                    <input class="form-control" id="inputEmail" name="class" type="text" placeholder="Enter your registra" readonly value="<?php  echo $row['type'];?>" />
                                    <label for="inputEmail">Content type</label>
                                </div>
                                <h4>Submit period</h4>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" name="urgency" type="text" placeholder="Enter your registra" readonly value="<?php  echo $row['urgency'];?>" />
                                    <label for="inputEmail">Submit period</label>
                                </div>
                                <h4>Comment *</h4> 
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" name="comment" type="text" placeholder="Enter your registra" required/>
                                    <label for="inputEmail">Your comments</label>
                                </div>     
                             <?php } ?>
                            
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                <button class="btn btn-primary" type="submit" name="submit" value="<?php  echo $row['urgency'];?>">Submit</button>
                            </div>
                        </form>
                                                    
                    </div>
                </main>
                <?php include('./includes/footer.html') ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
