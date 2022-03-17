<?php 
    session_start();
    require('db/dbconfig.php');
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $program = $_POST['program'];
        $code = $_POST['code'];
        
        // $con = $conn;
        $query = "INSERT INTO classes(code, program) values('$code', '$program')";
        if($con->query($query)){
            header("location:classes.php");
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
                        <h1 class="mt-4">New Class</h1>                        
                       
                          
                            
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="program" type="text" placeholder="Enter your registra" required />
                                <label for="inputEmail">Program</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="code" type="text" placeholder="Enter your registra" required />
                                <label for="inputEmail">UniqueCode</label>
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
