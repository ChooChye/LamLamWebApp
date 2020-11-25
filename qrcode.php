<?php
include('includes/header.php');
/* The PHP array. */
$array = array("Product" => "Coffee", "Price" => 1.5);

/* The JSON string created from the array. */
$json = json_encode($array);
$lcg = new Lcg();
$encrypted = $lcg->encrypt($json);
//echo '<br/>'.$encrypted .'<br/>';

/*$data = "T";
echo 'LCG = '.$lcg->next() .'<br/>';
$bytes = unpack("C*", $data);
echo 'unpack() = <br/>'; print_r($bytes) .' <br/>';
$xors = [];
foreach($bytes as $val){
    $next = $lcg->next();
    echo $next . '<br/>';
    $xors[] = $val ^ $next;
}
echo '<br/> Xors = <br/>'; print_r($xors);

echo "</br><b>TEST Bitwise</b></br>";
echo 65 % 84;*/


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('phpqrcode/qrlib.php');
    $path = 'img/qrcodes/';
    $file = $path . uniqid() . '.png';
    $text = 'Something';
    QRcode::png("Test", $file, 'H', 7);
}



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
                                <form actio="" method="post">
                                    <div class="form-group mb-4">
                                        <label><b>Product Category</b> <a href="#" style="font-size: 12px">(Add new category)</a></label>
                                        <select class="form-control">
                                            <option>Tops</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label><b>Product Name</b> <a href="#" style="font-size: 12px">(Add new item)</a></label>
                                        <select class="form-control">
                                            <option>Blue Sweatshirt</option>
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

                                <?php

                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    echo '    <center>
                                                <img src="' . $file . '"/><br/>
                                                <a href="#" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
                                              </center>';
                                } else {
                                    echo '<div align="center">
                                    <div style="border:1px solid #ccc; height:250px; width: 250px; padding:3%">
                                        <p style="padding-top: 25%; text-align: center">Fill up the form to generate a QR code</p>
                                    </div>
                                </div>';
                                }
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


