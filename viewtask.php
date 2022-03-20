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
                        <h2>Task Details</h2>
                        <br>                                                                                                     
                        <?php 
                         $id = $_GET['id'];                                
                         // $con = $conn;
                         $query = "SELECT * FROM task WHERE `task`.`id` = '$id'";
                         $ret = mysqli_query($con, $query);
                         while ($row=mysqli_fetch_array($ret)) { ?>
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-secondary text-white mb-4">
                                        <div class="card-header big">
                                        <i class="fa fa-book"></i> <?php  echo $row['subject'];?></div>
                                        <div class="card-body">
                                            <h3><?php  echo $row['type'];?></h3>
                                            <p><?php  echo $row['descr'];?></p>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                        <p class="small text-white"><strong>Status: </strong><?php  echo $row['status'];?></p>                                        
                                    </div>
                                </div>
                                </div>
                            </div>                                                                                                                                                                                                       
                        <?php } ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Submitted tasks
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Type</th> 
                                            <th>Urgency</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Comments</th>
                                            <th>Action</th>                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $empno = $_SESSION['empno'];
                                            $query = "SELECT * FROM `submission`, `task`, `student`, `trainer` WHERE `submission`.`taskid` = `task`.`id` AND `task`.`id` = '$id' AND `task`.`trainer` = '$empno' AND `task`.`trainer` = `trainer`.`emp_no` AND `submission`.`reg_no` = `student`.`reg_no`;";
                                            $ret = mysqli_query($con, $query);
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($ret)) {                                                                                            
                                        ?>
                                        
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $row['reg_no'];?></td>
                                            <td><?php echo $row['type'];?></td>
                                            <td><?php echo $row['urgency'];?></td>
                                            <td><?php echo $row['descr'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td><?php echo $row['comment'];?></td>
                                            <!-- <td><i class="fa fa-eye" ></i> view</td> -->
                                            <td>                                                                                                
                                                <a href="viewsubmission.php?id=<?php echo $row['sid'];?>"><button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-eye" ></i> view</button></a>
                                            </td>
                                        </tr>
                                        <?php $cnt=$cnt+1;}?>                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

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
