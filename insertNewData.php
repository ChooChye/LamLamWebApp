<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Manage Stock (Admin)');
$header->initHeader();

?>

<?php include('includes/navbar.php') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            <h4>Add New Stocks Data</h4><hr>
             <form action="productCode.php" method="post">
                <div class="form-group">
                    <input type="text " name="category" class="form-control" placeholder="Enter category">
                </div>

                <div class="form-group">
                    <input type="text " name="product_name" class="form-control" placeholder="Enter product name">
                </div>

                <div class="form-group">
                    <input type="text " name="desc" class="form-control" placeholder="Enter product description">
                </div>

                <div class="form-group">
                    <input type="number " name="price" class="form-control" placeholder="Enter product price">
                </div>

                <div class="form-group">
                    <input type="number " name="qty" class="form-control" placeholder="Enter quantity">
                </div>

                <div class="form-group">
                    <button type="submit" name="save_push_data" class="btn btn-primary">Add Data</button>
                    <button type="button" class="btn " onclick="location.href='manage_stock_admin.php'">Cancel</button>
                </div>
             </form>
        </div>
    </div>

</div>