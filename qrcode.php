<?php
//require_once('phpqrcode/qrlib.php');
//$path = 'img/qrcodes/';
//$file = $path.uniqid().'.png';
//$text = 'Something';
//QRcode::png($text, $file, 'H', 7);
include('includes/header.php');
?>

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include('includes/navbar.php') ?>

            <!-- Begin Page Content -->
            <div class="container">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard - Generate QR Code</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form>
                                    <div class="form-group mb-4">
                                        <label><b>Product Category</b></label>
                                        <select class="form-control">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label><b>Product Name</b></label>
                                        <select class="form-control">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="submit" class="btn btn-success btn-block" value="Generate QR Code">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div align="center">
                                    <div style="border:1px solid #ccc; height:250px; width: 250px; padding:3%">
                                        <p style="padding-top: 25%; text-align: center">Fill up the form to generate a QR code</p>
                                    </div>
                                </div>
                                <?php
//                                    echo '    <center>
//                                                <img src="img/qrcodes/5f8699bde8152.png"/><br/>
//                                                <a href="#" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
//                                              </center>'
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        <?php
        include('includes/footer.php');
        ?>
    </div>
    <!-- End of Main Content -->


