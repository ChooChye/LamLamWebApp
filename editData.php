<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Manage Stock (Admin)');
$header->initHeader();

$fb = new FBconnect('includes/');
$ref = "Categories";

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

if (isset($_POST['update'])){
    $category=$_POST['category'];
    $desc=$_POST['desc'];
    $price=$_POST['price'];
    $product_name=$_POST['product_name'];
    $qty=$_POST['qty'];
    $ref=$_POST['ref'];

    $data=[
        'category'  =>$category,
        'desc'  =>$desc,
        'price'  =>$price,
        'product_name'  =>$product_name,
        'qty'  =>$qty
    ];

    $pushData=$fb->database->getReference('Products')->update($data);

}
?>

<?php include('includes/navbar.php') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            <h4>Add New Stocks Data</h4><hr>
            <form action="productCode.php" method="post">
                <div class="form-group">
                    <label>Category:</label><br>
                    <select>

                        <?php
                        getCatList($fb);
                        ?>
                    </select>

                </div>

                <div class="form-group">
                    <label>Product Name:</label>
                    <input type="text " name="product_name" class="form-control">
                </div>

                <div class="form-group">
                    <label>Desciption:</label>
                    <input type="text " name="desc" class="form-control" >
                </div>

                <div class="form-group">
                    <label>Price    : </label>
                    <input type="number " name="price" class="form-control" >
                </div>

                <div class="form-group">
                    <label>Quantity :</label>
                    <input type="number " name="qty" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                    <button type="button" class="btn " onclick="location.href='manage_stock_admin.php'">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</div>
