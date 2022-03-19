<?php 
    session_start();
    require('db/dbconfig.php');
    require('db/class.php');
    require("api/sms.php");
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['close'])) {        
        header("location:submissions.php");           
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
                        <h2>Submission details</h2>
                        <br>                                                                                                     
                        <?php 
                         $id = $_GET['id'];                                
                         // $con = $conn;
                         $query = "SELECT * FROM task, submission, student WHERE `sid` = '$id' AND `task`.`id` = `sid` AND `student`.`reg_no` = `submission`.`reg_no`";
                         $ret = mysqli_query($con, $query);
                         while ($row=mysqli_fetch_array($ret)) { ?>
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-danger text-white mb-4">
                                        <div class="card-header big">
                                        <i class="fa fa-user-circle"></i> Student details</div>
                                        <div class="card-body">
                                            <h3><?php  echo $row['name'];?></h3>
                                            <p><?php  echo $row['reg_no'];?></p>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                        <p class="small text-white">Time: <?php  echo $row['time'];?></p>                                        
                                    </div>
                                </div>
                                </div>
                            </div>                                                                                                                                                                                                       
                             <form method="POST">
                                <h4>Initial Instructions</h4>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" name="instructions" type="text" placeholder="Enter your registra" readonly value="<?php  echo $row['descr'];?>" />
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
                                    <input class="form-control" id="inputEmail" name="comment" type="text" placeholder="Enter your registra" readonly value="<?php  echo $row['comment'];?>"/>
                                    <label for="inputEmail">Student Comment</label>
                                </div>     
                             <?php } ?>
                            
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                <button class="btn btn-danger" type="submit" name="close" value="close">Close</button>
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
