<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Generate Report');
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
                <input type="text"  class="form-control" name="inputName" >

            </div>
            <div class="col">

                <label for="exampleDataList" class="form-label">Category</label>

                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="" name="selectionCat">
                <datalist id="datalistOptions">
                    <?php
                    getCatList($fb);
                    ?>
                </datalist>
            </div>


            <div class="col">

                <label for="inputZip" class="form-label">Staff ID</label>
                <input type="text" class="form-control" id="inputZip" name="inputSID">
            </div>
            <div class="col">
                <label for="inputZip" class="form-label">Retailer ID</label>
                <input type="text" class="form-control" id="inputZip" name="inputRID">
            </div>
        </div>

         <div class="col-12 row g-3 mt-3">
                    <div class="col">

                        <label for="exampleDataList" class="form-label">Status</label>
                      <!--  <select class="form-control" aria-label="Default select example" name="selectStatus">
                            <option selected>In Stock</option>
                            <option value="">Out of Stock</option>
                            <option value="">Loan</option>

                        </select>-->

                        <input class="form-control" list="data" id="exampleDataList" placeholder="" name="selectStatus">
                        <datalist id="data">
                            <option>In Stock</option>
                            <option>Out of Stock</option>
                            <option>Loan</option>
                        </datalist>
                    </div>

                    <div class="col">

                        <label for="inputZip" class="form-label">Loan ID</label>
                        <input type="text" class="form-control" name="inputLID" >
                    </div>

                    <div class="col">

                        <label for="inputZip" class="form-label">Start Date</label>
                        <input class="form-control" data-date-format="mm/dd/yyyy" type="date" name="startDate">
                    </div>
                    <div class="col">
                        <label for="inputZip" class="form-label">End Date</label>
                        <input class="form-control" data-date-format="mm/dd/yyyy" type="date" name="EndDate">
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
            <th>Loan ID</th>
            <th>Loan Date</th>
        </tr>
        </thead>
        <tbody>


        <?php

        $array = array();
        $firebase = new FBconnect('includes/');
        $prodRef = "Products/";
        $fetchdata=$firebase->database->getReference($prodRef)->getValue();

        if (isset($_GET['inputName'])){
            $kword = strtoupper($_GET['inputName']);

            foreach ($fetchdata as $key => $row) {

                $name = strtoupper($row['product_name']);
                $nameForGUI = $row['product_name'];
                $testing = strtoupper($row['category']);
                $testingForGUI = strtoupper($row['category']);


                if (stripos($name, $kword)  !== false) {
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

        if (isset($_GET['selectionCat'])){
            $kword1 = strtoupper($_GET['selectionCat']);

            foreach ($fetchdata as $key => $row) {

                $testing = strtoupper($row['category']);

                if (stripos($testing, $kword1)  !== false) {
                    $category = $row['category'];
                    $qty = $row['qty'];
                    $name1 = $row['product_name'];

                    echo '<tr>
                    <td>'.$name1.'</td>
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

        $loadRef = "Loans/";
        $fetchdata1=$firebase->database->getReference($loadRef)->getValue();

        if (isset($_GET['selectStatus'])){
            $kwordsStatus = strtoupper($_GET['selectStatus']);
            $kwordRID = $_GET['inputRID'];
            $kwordSID = $_GET['inputSID'];
            $kwordLID = strtoupper($_GET['inputLID']);

            foreach ($fetchdata1 as $key1 ){

                foreach ($key1 as $key2=>$row2){
                    $status=  $row2['status'];
                    $retailerID=  $row2['retailerID'];
                    $staffID=  $row2['staffID'];
                    $loanID=  $row2['loanID'];
                    $loanDate=  $row2['loanDate'];

                    $upperRID= strtoupper( $row2['retailerID']);
                    $upperSID= strtoupper( $row2['staffID']);
                    $upperLID=  strtoupper($row2['loanID']);

                    if ($kwordsStatus="LOAN") {
                        $category = $row['category'];
                        $qty = $row['qty'];
                        $name1 = $row['product_name'];

                        echo '<tr>
                    <td>'.$name1.'</td>
                    <td>'.$category.'</td>
                    <td>'.$qty.'</td>
                     <td>Loans '.$status.'</td>
                    <td>'.$staffID.'</td>
                    <td>'.$retailerID.'</td>
                    <td>'.$loanID.'</td>
                    <td>'.$loanDate.'</td>
                    </tr>';
                    }else{
                        echo "error";
                    }

                    if ($kwordRID===$retailerID) {
                        $category = $row['category'];
                        $qty = $row['qty'];
                        $name1 = $row['product_name'];

                        echo '<tr>
                    <td>'.$name1.'</td>
                    <td>'.$category.'</td>
                    <td>'.$qty.'</td>
                     <td>Loans '.$status.'</td>
                    <td>'.$staffID.'</td>
                    <td>'.$retailerID.'</td>
                    <td>'.$loanID.'</td>
                    <td>'.$loanDate.'</td>
                    </tr>';
                    }

                    if ($kwordSID===$staffID) {
                        $category = $row['category'];
                        $qty = $row['qty'];
                        $name1 = $row['product_name'];

                        echo '<tr>
                    <td>'.$name1.'</td>
                    <td>'.$category.'</td>
                    <td>'.$qty.'</td>
                     <td>Loans '.$status.'</td>
                    <td>'.$staffID.'</td>
                    <td>'.$retailerID.'</td>
                    <td>'.$loanID.'</td>
                    <td>'.$loanDate.'</td>
                    </tr>';
                    }

                    if ($kwordLID===$loanID) {
                        $category = $row['category'];
                        $qty = $row['qty'];
                        $name1 = $row['product_name'];

                        echo '<tr>
                    <td>'.$name1.'</td>
                    <td>'.$category.'</td>
                    <td>'.$qty.'</td>
                     <td>Loans '.$status.'</td>
                    <td>'.$staffID.'</td>
                    <td>'.$retailerID.'</td>
                    <td>'.$loanID.'</td>
                    <td>'.$loanDate.'</td>
                    </tr>';
                    }
                }
            }
        }



            ?>
    </table>
</div>




<?php
include('includes/footer.php');
?>

