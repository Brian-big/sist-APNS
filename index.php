<?php  
    session_start();
    if (!isset($_SESSION['login'])){ 
        header('location:login.php');
    }
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Uploaded Content</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Completed Content</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Pending</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Cancelled</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                In Progress Tasks
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Content type</th>
                                            <th>Description</th>
                                            <th>Created at</th>
                                            <th>Submission</th>
                                            <th>In progress?</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Discussion </td>
                                            <td>Discussion</td>
                                            <td>2011/04/25</td>
                                            <td>-</td>
                                            <td>yes</td>
                                            <td>------</td>
                                        </tr>
                                        <tr>
                                            <td>Discussion </td>
                                            <td>Discussion</td>
                                            <td>2011/04/25</td>
                                            <td>-</td>
                                            <td>yes</td>
                                            <td>------</td>
                                        </tr>
                                        <tr>
                                            <td>Discussion </td>
                                            <td>Discussion</td>
                                            <td>2011/04/25</td>
                                            <td>-</td>
                                            <td>yes</td>
                                            <td>------</td>
                                        </tr>
                                        <tr>
                                            <td>Discussion </td>
                                            <td>Discussion</td>
                                            <td>2011/04/25</td>
                                            <td>-</td>
                                            <td>yes</td>
                                            <td>------</td>
                                        </tr>
                                        <tr>
                                            <td>Discussion </td>
                                            <td>Discussion</td>
                                            <td>2011/04/25</td>
                                            <td>-</td>
                                            <td>yes</td>
                                            <td>------</td>
                                        </tr>
                                        <tr>
                                            <td>Discussion </td>
                                            <td>Discussion</td>
                                            <td>2011/04/25</td>
                                            <td>-</td>
                                            <td>yes</td>
                                            <td>------</td>
                                        </tr>
                                        <tr>
                                            <td>Discussion </td>
                                            <td>Discussion</td>
                                            <td>2011/04/25</td>
                                            <td>-</td>
                                            <td>yes</td>
                                            <td>------</td>
                                        </tr>
                                        
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
