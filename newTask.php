<?php 
    session_start();
    require('db/dbconfig.php');
    require('db/dept.php');
    require("api/sms.php");
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $emp_no = $_SESSION['empno'];
        $descr = $_POST['descr'];
        $type = $_POST['type'];
        $urgency = $_POST['urgency'];
        $subject = $_POST['subject'];
        $sql = "INSERT INTO `task` ( `type`, `urgency`, `subject`, `descr`, `trainer`) VALUES ( '$type', '$urgency', '$subject', '$descr', '$emp_no')";
        // $query = "INSERT INTO `task` ( `type`, `urgency`, `class`, `decsr`, `trainer`) VALUES ('$type', '$urgency', '$class', '$descr', '$emp_no')";                
        if($con->query($sql)){
            $classquery = "SELECT `class` FROM `subject` WHERE `code` = '$subject'";
            
            $res1 = mysqli_query($con, $classquery);            
            while ($row = mysqli_fetch_assoc($res1)){
                $class = $row['class'];
                $recipientsQuery = "select `telephone` from `student` WHERE `class` = '$class'";
                $res = mysqli_query($con, $recipientsQuery) or die(mysql_error());
                
                $message = $subject. ': New '.$type. ' added. Description: '.$descr. ' submission: ' .$urgency;
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
                header("location:dashboard.php");
            }
           
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
                        <h1 class="mt-4">New Academic content</h1>                                                                                                     
                        <form method="POST">
                            <h4>Type of content *</h4>
                            <div data-toggle="buttons">                                
                                <input type="radio" name="type" value="notes" id="notes" autocomplete="off" checked > Notes <br>                                
                                <input type="radio" name="type" value="assignment" id="assignment" autocomplete="off"> Assignment <br>                                
                                <input type="radio" name="type" value="video" id="video" autocomplete="off"> Video on related topic <br>                                
                                <input type="radio" name="type" value="other" id="other" autocomplete="off"> Other <br>
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
                            <div class="form-group">
								<label>Subject *</label>
								<select class="form-control" name="subject" id="class" required>
									<?php 
                                        $trainer = $_SESSION['empno'];                                                                                                                          
                                        $query=mysqli_query($con,"SELECT * from `subject` WHERE `trainer` = '$trainer'");                                               
										while($row=mysqli_fetch_array($query))
											{?>    
                                            <option value="<?php echo $row['code'];?>"><?php echo $row['code'];?></option>
                  					<?php } ?> 
								</select>
                            </div>
                            <br> 
                            <h4>Description *</h4>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" name="descr" type="text" placeholder="Enter your registra" required />
                                <label for="inputEmail">Enter description for the task</label>
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
