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

    <form class="col-12 row g-2">

        <div class="col-12 row g-3">
            <div class="col-4">

                <label for="inputZip" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="inputName" >

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
            <button type="submit" class="btn btn-primary" name="search">Search</button>
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

        if (isset($_POST['search'])){
            $name=$_POST['product_name'];
            $category=$_POST['category'];
            $qty=$_POST['qty'];


        }
        $firebase = new FBconnect('includes/');
        $prodRef="Products/";
        //  $token = $_GET['token'];
        $fetchdata=$firebase->database->getReference($prodRef)->getValue();

        foreach ($fetchdata as $key=>$row){


            $name=$row['product_name'];
            $category=$row['category'];
            $qty=$row['qty'];


        ?>

        <tr>

            <td>
                <?php


                echo $name;



                ?></td>
            <td><?php echo $category; ?></td>
            <td><?php echo $qty; ?></td>
            <td><?php echo "In Stocks" ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
            <?php

        }
        ?>

        <?php

         //   $str = $row['product_name'];
        //    echo filter_var($str,filter_input(INPUT_GET,'inputName',FILTER_DEFAULT));
          //  echo $newstr;

        ?>

    </table>
</div>




<?php
include('includes/footer.php');
?>

