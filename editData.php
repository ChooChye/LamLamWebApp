<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Manage Stock (Admin)');
$header->initHeader();

$fb = new FBconnect('includes/');
//$ref = "Categories";
$token = $_GET['token'];
$getdata=$fb->database->getReference('Products')->getChild($token)->getValue();

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

//Update product
if (isset($_POST['update'])) {
    $child = $_POST['category'];
    try {
        $data = [
            "category" => $child,
            "product_name" => $_POST['product_name'],
            "desc" => $_POST['desc'],

            "qty" => $_POST['qty'],
            "price" => $_POST['price']
        ];


        $ref="Products/".$token;

      $fb->database->getReference($ref)->update($data);

       // echo alertSuccess(' Data has been updated successfully');
        echo alertSuccess('<b>' . $_POST['product_name'] . '</b> has been updated successfully</div>');
    } catch (Exception $e) {
        echo alertError($e);
    }
}


?>


<?php include('includes/navbar.php') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            <h4>Update Stocks Data</h4><hr>
            <form action="" method="post">
                <input type="hidden" name="token" value="<?php echo $token?>">
                <div class="form-group">
                    <label>Category:</label><br>
                    <select name="category" class="form-control" >
                        <option selected><?php echo $getdata['category']?></option>
                        <?php
                        getCatList($fb);
                        ?>
                    </select>

                </div>

                <div class="form-group">
                    <label>Product Name:</label>
                    <input type="text " name="product_name" class="form-control"
                           value="<?php echo $getdata['product_name']?>">
                </div>

                <div class="form-group">
                    <label>Desciption:</label>
                    <input type="text " name="desc" class="form-control"
                           value="<?php echo $getdata['desc']?>">
                </div>

                <div class="form-group">
                    <label>Price    : </label>
                    <input type="number " name="price" class="form-control"
                           value="<?php echo $getdata['price']?>">
                </div>

                <div class="form-group">
                    <label>Quantity :</label>
                    <input type="number " name="qty" class="form-control"
                           value="<?php echo $getdata['qty']?>">
                </div>

                <div class="form-group">
                    <button type="submit" name="update" class="btn btn-primary" >Update Data</button>
                    <button type="button" class="btn " onclick="location.href='manage_stock_admin.php'">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</div>
