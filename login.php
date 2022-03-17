<?php
session_start();
require('db/dbconfig.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username =  $_POST['username'];
    $password = $_POST['password'];
    
    // $con = $conn;
    $query = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $count = mysqli_num_rows($res);

    echo $count;
    if ($count == 1) {
        if ($row['user_type'] == 0) {
            $_SESSION['login'] = $row['sno'];
            header("location:index.php");
        }
        if ($row['user_type'] == 1) {
            $_SESSION['login'] = $row['sno'];
            header("location:dashboard.php");
        }
        if ($row['user_type'] == 2) {
            $_SESSION['login'] = $row['sno'];
            header("location:dashboardhod.php");
        }
    }
    

}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('includes/header.html') ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="username" type="text" placeholder="Enter your registra" />
                                                <label for="inputEmail">Registration number</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">                                                
                                                <button class="btn btn-primary" type="submit" name="login" href="index.html">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <?php include('./includes/footer.html') ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
