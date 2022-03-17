<?php 
    session_start();
    require('db/dbconfig.php');
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $emp_no = $_POST['emp_no'];
        $id_no = $_POST['id_no'];
        $telephone = $_POST['telephone'];
        $department = $_POST['department'];
        
        
        $query = "INSERT INTO `trainer` (`id`, `name`, `emp_no`, `id_no`, `telephone`, `department`) VALUES (NULL, '$name', '$emp_no', '$id_no', '$telephone', '$department')";
        if($con->query($query)){
            header("location:trainers.php");
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
                        <h1 class="mt-4">Add new trainer</h1>                                                                                                     
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="name" type="name" placeholder="Enter your registra" required />
                                <label for="inputEmail">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="emp_no" type="text" placeholder="Enter your registra" required />
                                <label for="inputEmail">Employee Number</label>
                            </div>                                                                               
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="id_no" type="text" placeholder="Enter your registra" required />
                                <label for="inputEmail">National id number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="department" type="text" placeholder="Enter your registra" required />
                                <label for="inputEmail">Department</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="telephone" type="text" placeholder="Enter your registra" required />
                                <label for="inputEmail">Telephone</label>
                            </div>                                                               
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
