<?php

//Init
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Generate QR Code');
$header->initHeader();

//process
$fb = new FBconnect('includes/');

$ref = "Categories";

//Add new category
if (isset($_POST['newCategoryBtn'])) {
    $newCategory = ucfirst($_POST['newCategory']);
    try {
        if ($fb->checkNode($ref, $newCategory)) {
            echo alertInfo('<b>' . $_POST['newCategory'] . '</b> is already in the list</div>');
        } else {
            $fb->database->getReference($ref)->getChild($newCategory)->push("null");
        }
        echo alertSuccess('<b>' . $_POST['newCategory'] . '</b> has been added successfully</div>');
    } catch (Exception $e) {
        echo alertError($e);
    }
}

//Add new product
if (isset($_POST['newProductBtn'])) {
    if(empty($_POST['category'])){
        echo alertError("<b>Please select a category first</b>");
    }else{
        $child = $_POST['category'];
        try {
            $data = [
                "category" => $child,
                "product_name" => $_POST['newProduct'],
                "desc" => $_POST['prodDesc'],
                "qty" => $_POST['qty'],
                "image" => $_FILES['image']['name'],
                "price" => $_POST['price']
            ];

            $fb->database->getReference("Products")->push($data);
            echo alertSuccess('<b>' . $_POST['newProduct'] . '</b> has been added successfully</div>');
        } catch (Exception $e) {
            echo alertError($e);
        }
    }
}


/* The JSON string created from the array. */
//Generate QR Code
if (isset($_POST['genBtn']) && isset($_POST['lProd']) && isset($_POST['lCat'])) {
    //Init QR library
    require_once('phpqrcode/qrlib.php');
    $path = 'img/qrcodes/';
    $file = $path . uniqid() . '.png';

    //POST DATA
    $cat = $_POST['lCat'];
    $prod = $_POST['lProd'];


    //Init Firebase Data
    $result = $fb->database->getReference('Products')->getChild($prod)->getValue();

    $resultInArr = Array($result);

    //add ID into array
    foreach($resultInArr as $resultsInArr){
        $resultsInArr["id"] = $prod;
    }

    $json = json_encode($resultsInArr);
    QRcode::png($json, $file, 'H', 7);
}


function getCatList($fb)
{
    $listArray = array();
    $i = 0;
    $cat = $fb->database->getReference('Categories')->getValue();
    foreach ($cat as $collection => $colRows) {
        $listArray[$i] = $collection;
        $i++;
    }
    sort($listArray);
    for ($j = 0; $j < count($listArray); $j++) {
        echo '<option>' . $listArray[$j] . '</option>';
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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <label><b>Product Category</b> <a href="#" data-toggle="modal"
                                                                          data-target="#newCategory"
                                                                          style="font-size: 12px">(Add new category)</a></label>
                                        <select class="form-control" name="lCat" id="lCat">
                                            <option selected disabled>Select a Category</option>
                                            <?php
                                            getCatList($fb);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label><b>Product Name</b> <a href="#" data-toggle="modal"
                                                                      data-target="#newProduct" style="font-size: 12px">(Add
                                                new item)</a></label>
                                        <select class="form-control" name="lProd" id="lProd">
                                            <option selected disabled>Select a Product</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="submit" name="genBtn" id="genBtn" class="btn btn-success btn-block"
                                               disabled value="Generate QR Code">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <?php
                                if (isset($_POST['genBtn'])) {
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


        <script>
            /*Main Document*/
            $(document).ready(function () {

                controlGenBtn(true);

            });

            /*Methods*/
            function controlGenBtn(bool) {
                $('#genBtn').prop("disabled", bool);
            }


            /*onChange methods*/
            $('#lCat').on('change', function () {
                var ref = $("#lCat option:selected").text();
                var childKey = null;
                $('#lProd').find('option').remove().end().append("<option selected disabled>Select Product</option>");
                controlGenBtn(true);
                var database = firebase.database().ref("Products");

                database.once("value", function (snapshot) {

                    snapshot.forEach(function (childSnapshot) {
                        childKey = childSnapshot.key;
                        const cat = childSnapshot.val();

                        //Check if child is null
                        if (cat !== "null") {
                            if(cat.category === ref){
                                $("#lProd").append('<option value="' + childKey + '">' + cat.product_name + '</option>');
                            }
                        }
                    });
                })
            });

            $('#lProd').on('change', function () {
                var selectedCat = $('#lCat option:selected');
                var selectedProd = $('#lProd option:selected');
                //console.log(selectedCat.text() + " | " + selectedProd.text() );
                if (selectedCat.text() === "Select Category") {
                    if (selectedProd.text() === "Select Product") {
                        controlGenBtn(true);
                    }
                } else {
                    if (selectedProd.text() !== "Select Product") {
                        controlGenBtn(false);
                    }
                }
            })

            function uploadImage(){
                const ref = firebase.storage().ref().child("products")
                const file = document.querySelector("#image").files[0]
                const name = file.name
                const metadata = {
                    contentType:file.type
                }
                const task = ref.child(name).put(file, metadata)
                task
                .then(snapshot => snapshot.ref.getDownloadURL())
                .then(url =>{
                    //console.log(url)
                })
            }
        </script>

        <!-- Add new Category Modal -->
        <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="newCategoryTitle"
             aria-hidden="true">
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
                                <input type="text" name="newCategory" class="form-control" placeholder="Category Name" required/>
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
        <div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="newProductTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <div class="form-row">
                                    <select name="category" class="form-control" required>
                                        <option selected disabled>Select a Category</option>
                                        <?php
                                        getCatList($fb);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-row">
                                    <input type="text" name="newProduct" id="newProduct" class="form-control"
                                           placeholder="Product Name" required/>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-row">
                                    <input type="text" name="prodDesc" id="prodDesc" class="form-control"
                                           placeholder="Product Description" required/>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-row">
                                    <input type="number" name="qty" id="qty" class="form-control"
                                           placeholder="Stock Quantity" required/>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-row">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">RM</div>
                                        </div>
                                        <input type="text" name="price" id="price" class="form-control"
                                               placeholder="Price" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-row">
                                    <input type="file" name="image" id="image" class="form-control" required style="overflow: hidden"/>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="newProductBtn" class="btn btn-primary" onclick="uploadImage()" value="Add"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Main Content -->


