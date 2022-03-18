<?php 
    session_start();
    require('db/dbconfig.php');
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $class = $_POST['class'];
        $reg = $_POST['reg'];
        $tel = $_POST['tel'];

        if (isset($_GET['updatereg'])) {
            $query = "UPDATE student SET `name` = '$name', `telephone` = '$tel' WHERE `reg_no` = '$reg'";
            if($con->query($query)){
                header("location:class.php?code=$class");
            }
        }
        else{
            $query = "INSERT INTO student(`name`, class, reg_no, telephone) values('$name', '$class', '$reg', '$tel')";
            if($con->query($query)){
                header("location:class.php?code=$class");
            }
        }                        
    
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "./includes/header.html" ?>
    <body class="sb-nav-fixed">
        <?php include "./includes/topnav.html" ?>
        <?php include "./includes/sidenavhod.html" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <?php 
                            if (isset($_GET['updatereg'])) {                                                    
                                $reg = $_GET['updatereg'];                                
                                // $con = $conn;
                                $query = "SELECT * FROM  student WHERE `reg_no` = '$reg'";
                                $ret = mysqli_query($con, $query);
                                while ($row=mysqli_fetch_array($ret)) { ?>                                                                                     
                                    <h1 class="mt-4">editing <?php echo $row['reg_no'];?></h1>                                                                         
                            
                                    <form method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="name" type="text" placeholder="Enter your registra" required value="<?php  echo $row['name'];?>" />
                                            <label for="inputEmail">Name</label>
                                        </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" name="class" type="text" placeholder="Enter your registra" readonly value="<?php  echo $row['class'];?>" />
                                        <label for="inputEmail">Class</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" name="reg" type="text" placeholder="Enter your registra" readonly value="<?php  echo $row['reg_no'];?>" />
                                        <label for="inputEmail">Registration number</label>
                                    </div>  
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" name="tel" type="text" placeholder="Enter your registra" required value="<?php  echo $row['telephone'];?>" />
                                        <label for="inputEmail">Telephone number</label>
                                    </div>     
                                    <?php }}
                            else { ?>
                                <h1 class="mt-4">New Student</h1>                                                                                                     
                                <form method="POST">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" name="name" type="text" placeholder="Enter your registra" required />
                                    <label for="inputEmail">Name</label>
                                </div>

                                <?php 
                                    if (isset($_GET['updateclass'])) {
                                        $class = $_GET['updateclass'];
                                        ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="class" type="text" value="<?php  echo $class;?>" readonly />
                                            <label for="inputEmail">Class</label>
                                        </div>
                                    <?php }
                                    else { ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="class" type="text" placeholder="Enter your registra" readonly />
                                            <label for="inputEmail">Class</label>
                                        </div>
                                    <?php }
                                ?>
                                
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" name="reg" type="text" placeholder="Enter your registra" required />
                                    <label for="inputEmail">Registration number</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" name="tel" type="text" placeholder="Enter your registra" required />
                                    <label for="inputEmail">Telephone number(in +2547 format)</label>
                                </div>
                            <?php }
                            ?>                                                        
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
