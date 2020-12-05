<?php

//Init
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Generate QR Code');
$header->initHeader();



//process
$fb = new FBconnect('includes/');
if(isset($_POST['newCategoryBtn'])){
    try{
        $data = [
                "type" => $_POST['newCategory']
        ];
        $fb->insertData('Category', $data);

        echo alertSuccess('<b>'.$_POST['newCategory'].'</b> has been added successfully</div>');
    }catch (Exception $e){
        echo alertError($e);
    }
}

if(isset($_POST['newProductBtn'])){
    try{
        $data = [
                "type" => $_POST['newProduct']
        ];
        $fb->insertData('Products', $data);

        echo alertSuccess('<b>'.$_POST['newProduct'].'</b> has been added successfully</div>');
    }catch (Exception $e){
        echo alertError($e);
    }
}

//Generate QR


/* The JSON string created from the array. */


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('phpqrcode/qrlib.php');
    $path = 'img/qrcodes/';
    $file = $path . uniqid() . '.png';


    if(isset($_POST['genBtn']) && isset($_POST['lProd']) && isset($_POST['lCat'])){
        $cat = $_POST['lCat'];
        $prod = $_POST['lProd'];
        $array = array(
                "id" => uniqid(),
                "Category" => $cat,
                "Product" => $prod,
        );
        $json = json_encode($array);
        QRcode::png($json, $file, 'H', 7);
    }

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
                                        <label><b>Product Category</b> <a href="#" data-toggle="modal" data-target="#newCategory" style="font-size: 12px">(Add new category)</a></label>
                                        <select class="form-control" name="lCat">
                                            <option selected>Select a Category</option>
                                            <?php
                                            $postData = $fb->database->getReference('Category')->getValue();
                                            foreach($postData as $key => $rows){
                                                echo '<option>'.$rows['type'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label><b>Product Name</b> <a href="#" data-toggle="modal" data-target="#newProduct" style="font-size: 12px">(Add new item)</a></label>
                                        <select class="form-control" name="lProd">
                                            <option selected>Select a Product</option>
                                            <?php
                                            $newProduct = $fb->database->getReference('Products')->getValue();
                                            foreach($newProduct as $key => $rows){
                                                echo '<option>'.$rows['type'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="submit" name="genBtn" class="btn btn-success btn-block" value="Generate QR Code">
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

        <!-- Add new Category Modal -->
        <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="newCategoryTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group mb-3">
                                <input type="text" name="newCategory" class="form-control" placeholder="Category Name"/>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="newCategoryBtn" class="btn btn-primary" value="Add"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add new Product Modal -->
        <div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="newProductTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group mb-3">
                                <input type="text" name="newProduct" class="form-control" placeholder="Product Name"/>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="newProductBtn" class="btn btn-primary" value="Add"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->


