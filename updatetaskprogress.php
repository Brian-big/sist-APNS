<?php 
    session_start();
    require('db/dbconfig.php');
    require('db/dept.php');
    require("api/sms.php");
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET['id'];
        $emp_no = $_SESSION['empno'];
        $descr = $_POST['descr'];        
        $urgency = $_POST['urgency'];
        $status = $_POST['status'];       
        $sql = "UPDATE `task` SET `descr` = '$descr', `status` = '$status' WHERE `task`.`id` = '$id'";        
        if($con->query($sql)){
            $sql1 = "SELECT `task`.`subject`, `task`.`id` , `subject`.`class`, `subject`.`code` FROM `task`, `subject` WHERE `task`.`id` = '$id' AND `task`.`subject` = `subject`.code`";
            $ret = mysqli_query($con, $sql1);
            while ($row_ = mysqli_fetch_array($ret)) {
                $class = $row_['class'];
                $recipientsQuery = "select `telephone` from `student` WHERE `class` = '$class'";
                $res = mysqli_query($con, $recipientsQuery) or die(mysql_error());
                
                $message = $row_['subject']. ': status changed: '.$status. '. Submission: ' .$urgency;
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
            }
            header("location:dashboard.php");                    
        }    
    
    }
// $AT.sendMessage($recipients, $message);     
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "./includes/header.html" ?>
    <body class="sb-nav-fixed">
        <?php include "./includes/topnav.html" ?>
        <?php include "./includes/sidenavtrainer.html" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <?php 
                            $id = $_GET['id'];                                                            
                            $query = "SELECT * FROM task WHERE `task`.`id` = '$id'";
                            $ret = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($ret)) {?>
                                <h1 class="mt-4">Update task</h1>                                                                                                     
                                <form method="POST">
                                    <h4>Task status *</h4>
                                    <div data-toggle="buttons">                                
                                        <input type="radio" name="status" value="open" id="pending" autocomplete="off" > Open <br>                                
                                        <input type="radio" name="status" value="closed" id="completedt" autocomplete="off"> Closed <br>                                
                                        <input type="radio" name="status" value="cancelled" id="video" autocomplete="off"> Cancelled <br>                                
                                    </div>       
                                    <h4>Urgency *</h4>
                                    <div class="" data-toggle="buttons">
                                        <input type="radio" name="urgency" value="one day" id="notes" autocomplete="off"  checked > One Day <br>
                                        <input type="radio" name="urgency" value="one week" id="assignment" autocomplete="off"> One Week <br>                                
                                        <input type="radio" name="urgency" value="one month" id="video" autocomplete="off"> One Month <br>                                                            
                                        <input type="radio" name="urgency" value="end of term" id="endofterm" autocomplete="off"> End of Term <br>                              
                                        <input type="radio" name="urgency" value="no submission" id="other" autocomplete="off"> No submission <br>                              
                                    </div>
                                    <br>
                            
                                    <h4>Description *</h4>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" name="descr" type="text" placeholder="Enter your registra" required value="<?php echo $row['descr'] ?>"/>
                                        <label for="inputEmail">Update description / Instructions for the task</label>
                                    </div>                                
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                    </div>
                                </form>
                            
                        <?php }?>                        
                                                    
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
