<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Manage Stock (Admin)');
$header->initHeader();

$fb = new FBconnect('includes/');
$ref = "Categories";

$prodRef = "Products/";
$fetchdata = $fb->database->getReference($prodRef)->getValue();


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


//Add new product
if (isset($_POST['save_push_data'])) {
    $child = $_POST['category'];



    try {
        $data = [
            "category" => $child,
            "product_name" => $_POST['productName'],
            "desc" => $_POST['desc'],
            "image" => "no_image.png",
            "qty" => $_POST['qty'],
            "price" => $_POST['price']
        ];

      /*  if  (isset($_POST['productName'])) {
            $kword = strtoupper($_POST['productName']);
            foreach ($fetchdata as $key => $row) {
                $pname = strtoupper($row['product_name']);
                $testingName = $row['product_name'];
                if ($kword == $pname) {
                    echo alertError($_POST['productName'] . " <b> IS EXISTED</b>");
                }
            }
        }*/

       /* if(!checkString($_POST['productName'])){
            echo alertError($_POST['productName'] . " must not contain these symbols <b>/ . # $ [ ]</b>");

        }*/
    if  (isset($_POST['productName'])){
            $kword = strtoupper($_POST['productName']);
            foreach ($fetchdata as $key => $row) {
                $pname = strtoupper($row['product_name']);
                $testingName=$row['product_name'];
                if ($kword==$pname) {
                    echo alertError($_POST['productName'] . " <b> IS EXISTED</b>");
                }


            }

        if(!checkString($_POST['productName'])){
            echo alertError($_POST['productName'] . " must not contain these symbols <b>/ . # $ [ ]</b>");

        }
        }else{
            //success
            echo alertSuccess(' SUCCESS TESTING');
          //  $fb->database->getReference("Products/")->push($data);
           // echo alertSuccess('<b>' . $_POST['productName'] . '</b> has been added successfully</div>');
        }

    } catch (Exception $e) {
        echo alertError($e);
    }
}


function checkString($string){
    $stat = true;
    if (strpos($string, '/') !==false){
        $stat = false;
    }elseif (strpos($string, '.') !==false){
        $stat = false;
    }elseif (strpos($string, '#') !==false){
        $stat = false;
    }elseif (strpos($string, '$') !==false){
        $stat = false;
    }elseif (strpos($string, '[') !==false){
        $stat = false;
    }elseif (strpos($string, ']') !==false){
        $stat = false;
    }
    return $stat;
}
?>

<?php include('includes/navbar.php') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            <h4>Add New Stocks Data</h4><hr>
             <form action="" method="post">
                <div class="form-group">
                    <label>Category:</label><br>
                    <select name="category" class="form-control">

                        <?php
                        getCatList($fb);
                        ?>
                    </select>

                </div>

                <div class="form-group" >
                    <label>Product Name:</label>
                    <input type="text "  name="productName" class="form-control"  required>

                </div>

                <div class="form-group">
                    <label>Desciption:</label>
                    <input type="text " name="desc" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Price    : </label>
                    <input type="number " name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Quantity :</label>
                    <input type="number " name="qty" class="form-control" required>
                </div>

                <div class="form-group" >
                    <button type="submit"  name="save_push_data" class="btn btn-primary">Add Data</button>
                    <button type="button" class="btn " onclick="location.href='manage_stock_admin.php'">Cancel</button>
                </div>
             </form>
        </div>
    </div>

</div>

