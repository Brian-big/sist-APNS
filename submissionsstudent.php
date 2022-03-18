<?php  
    session_start();
    require('db/dbconfig.php');
    require('db/class.php');
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
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
                        <h1 class="mt-4">My submissions</h1>                                                                          
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tasks
                            </div>
                            <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>                                            
                                            <th>Type</th> 
                                            <th>Urgency</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <!-- <th>Action</th>                                            -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $regno = $_SESSION['regno'];
                                            $class = $_SESSION['class'];
                                            $sql = "SELECT * FROM `submission`, `task`, `student`, `trainer` WHERE `submission`.`taskid` = `task`.`id` AND `submission`.`reg_no` = '$regno' AND `task`.`trainer` = `trainer`.`emp_no` AND `submission`.`reg_no` = `student`.`reg_no`;";
                                            $query = "SELECT * FROM task WHERE `class` = '$class'";
                                            $ret = mysqli_query($con, $sql);
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($ret)) {                                                                                            
                                        ?>
                                        
                                        <tr>
                                            <td><?php echo $cnt;?></td>                                            
                                            <td><?php echo $row['type'];?></td>
                                            <td><?php echo $row['urgency'];?></td>
                                            <td><?php echo $row['descr'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <!-- <td><i class="fa fa-eye" ></i> view</td> -->
                                            <!-- <td>                                                
                                                <a href="edittrainee.php?updatereg=<?php echo $row['reg_no'];?>"><button type="submit" class="btn btn-sm btn-warning"> <i class="fa fa-eye" ></i> view</button></a>                                                
                                            </td> -->
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
