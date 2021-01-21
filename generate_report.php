<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Generate Report');
$header->initHeader();


$fb = new FBconnect('includes/');
$ref = "Categories";


//if (isset($_POST['search'])) {
//  $getdata = $fb->database->getReference('Products')->getChild($token)->getValue();
//}

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
<?php include('includes/navbar.php') ?>
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Generate Report</h1>
    </div>

    <form class="col-12 row g-2" method="get">

        <div class="col-12 row g-3">
            <div class="col-4">

                <label for="inputZip" class="form-label">Product Name</label>
                <input type="text" name="keyword" class="form-control" id="inputName" >

            </div>
            <div class="col">

                <label for="exampleDataList" class="form-label">Category</label>

                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="">
                <datalist id="datalistOptions">
                    <!-- <option value="Dresses">
                     <option value="Jeans">
                     <option value="Tops">-->
                    <?php
                    getCatList($fb);
                    ?>
                </datalist>
            </div>

            <div class="col">

                <label for="exampleDataList" class="form-label">Status</label>

                <!-- <input class="form-control" list="datalistOptions" >
                 <datalist>
                     <option value="In Stock">
                     <option value="Out of Stock">
                     <option value="Loan">
                 </datalist>-->

                <select class="form-control" aria-label="Default select example">
                    <option selected>In Stock</option>
                    <option value="">Out of Stock</option>
                    <option value="">Loan</option>

                </select>
            </div>
            <div class="col">

                <label for="inputZip" class="form-label">Staff ID</label>
                <input type="text" class="form-control" id="inputZip" >
            </div>
            <div class="col">
                <label for="inputZip" class="form-label">Retailer ID</label>
                <input type="text" class="form-control" id="inputZip" >
            </div>
        </div>


        <div class="col-12 mt-4" >
            <button type="submit" class="btn btn-primary">Search</button>
            <button type="submit" class="btn" style="border-color: black">Reset</button>
        </div>
    </form>

    <br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Category </th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Staff ID</th>
            <th>Retailer ID</th>
            <th>Loan Date</th>
            <th>Return Date</th>
        </tr>
        </thead>
        <tbody>


        <?php

        if (isset($_GET['keyword'])){
            $kword = strtoupper($_GET['keyword']);
            /*$name=$_POST['product_name'];
            $category=$_POST['category'];
            $qty=$_POST['qty'];*/


        $array = array();
        $firebase = new FBconnect('includes/');
        $prodRef = "Products/";
        //  $token = $_GET['token'];
        //$fetchdata=$firebase->database->getReference($prodRef)->getValue();

        $fetchdata=$firebase->database->getReference($prodRef)->getValue();

        foreach ($fetchdata as $key => $row) {

            $name = strtoupper($row['product_name']);
            $nameForGUI = $row['product_name'];

            if (strpos($name, $kword) !== false) {
                $category = $row['category'];
                $qty = $row['qty'];

                echo '<tr>
                <td>'.$nameForGUI.'</td>
                <td>'.$category.'</td>
                <td>'.$qty.'</td>
                <td>In Stocks</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>';
            }
        }
        }
            ?>
    </table>
</div>




<?php
include('includes/footer.php');
?>

