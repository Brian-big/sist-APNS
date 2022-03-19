<?php  
    session_start();
    require('db/dbconfig.php');
    require('db/class.php');
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $sn=$_SESSION['login'];
        $first=$_POST['email'];
        $second=$_POST['second'];
        
        if ($first != $second) {
            echo "<script>alert('Passwords don't match!');</script>";
        }
        $query=mysqli_query($con,"UPDATE `user` set Password='$second'  where  sno='$sn'");
        if($query){
	        echo "<script>alert('Password Changed!');</script>";
	        session_destroy();
	        header("location:javascript://history.go(-1)");            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "./includes/header.html" ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Reset password</h3></div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row mb-3">                                            
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="first" type="password" placeholder="name@example.com" />
                                                <label for="inputEmail">New password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="second" type="password" placeholder="name@example.com" />
                                                <label for="inputEmail">Confirm</label>
                                            </div>                                            
                                            <div class="mt-4 mb-0">
                                                <button class="btn btn-primary btn-block" type="submit" href="login.html">Change password</buttonv>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; SIST 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script type="text/javascript">

	        function checkpass(){
	        if(document.changepassword.first.value!=document.changepassword.confirmpassword.value){
		        alert('New Password and Confirm Password field does not match');
		        document.changepassword.confirmpassword.focus();
		        return false;
	        }
		    return true;
	    } 
	    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
