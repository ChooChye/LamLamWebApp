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

                <label for="exampleDataList" class="form-label">Status</label>

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

                <label for="inputZip" class="form-label">Staff ID</label>
                <input type="text" class="form-control" id="inputZip" name="inputSID">
            </div>
            <div class="col">
                <label for="inputZip" class="form-label">Retailer ID</label>
                <input type="text" class="form-control" id="inputZip" name="inputRID">
            </div>


        </div>

        <div class="col-12 mt-4" >
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="generate_report.php" class="btn" style="border-color: black">Reset</a>
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
        $loadRef = "Loans/";
        $fetchdata1=$firebase->database->getReference($loadRef)->getValue();

        //GENERATE PRODUCT NAME RESULT
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
                if ($qty>0){
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
                }elseif ($qty==0){
                    echo '<tr>
                    <td>'.$nameForGUI.'</td>
                    <td>'.$category.'</td>
                    <td>'.$qty.'</td>
                    <td>Out of Stocks</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>';
                }


                    foreach ($fetchdata1 as $key1 ){

                        foreach ($key1 as $key2=>$row2){
                            $status=  $row2['status'];
                            $retailerID=  $row2['retailerID'];
                            $staffID=  $row2['staffID'];
                            $loanID=  $row2['loanID'];
                            $loanDate=  $row2['loanDate'];
                            $test= $row2['productName'];

                            foreach ($test as $key3 => $row3)
                            {
                                if ($key3==$nameForGUI){
                                    echo '<tr>
                    <td>'.$nameForGUI.'</td>
                    <td>'.$category.'</td>
                    <td>'.$row3.'</td>
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
                }
            }
        }

        //GENERATE CATEGORY RESULT
        if (isset($_GET['selectionCat'])){
            $kword1 = strtoupper($_GET['selectionCat']);

            foreach ($fetchdata as $key => $row) {

                $testing = strtoupper($row['category']);

                if (stripos($testing, $kword1)  !== false) {
                    $category = $row['category'];
                    $qty = $row['qty'];
                    $name1 = $row['product_name'];
                if ($qty>0){
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
                }elseif ($qty==0){
                    echo '<tr>
                    <td>'.$name1.'</td>
                    <td>'.$category.'</td>
                    <td>'.$qty.'</td>
                    <td>Out of Stocks</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>';
                }


                    foreach ($fetchdata1 as $key1 ){

                        foreach ($key1 as $key2=>$row2){
                            $status=  $row2['status'];
                            $retailerID=  $row2['retailerID'];
                            $staffID=  $row2['staffID'];
                            $loanID=  $row2['loanID'];
                            $loanDate=  $row2['loanDate'];
                            $test= $row2['productName'];

                            foreach ($test as $key3 => $row3)
                            {
                                if ($key3==$name1){
                                    echo '<tr>
                    <td>'.$name1.'</td>
                    <td>'.$category.'</td>
                    <td>'.$row3.'</td>
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
                }
            }
        }

        //GENERATE STATUS RESULT
        if (isset($_GET['selectStatus'])){
            $kwordsStatus = strtoupper($_GET['selectStatus']);
            $kwordRID = $_GET['inputRID'];
            $kwordSID = $_GET['inputSID'];
            $kwordLID = strtoupper($_GET['inputLID']);

            foreach ($fetchdata as $key => $row) {

                $testing = strtoupper($row['category']);

                if ($kwordsStatus==="IN STOCK") {
                    $category = $row['category'];
                    $qty = $row['qty'];
                    $name1 = $row['product_name'];
                if ($qty>0){
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

                }elseif ($kwordsStatus==="OUT OF STOCK"){
                    $category = $row['category'];
                    $qty = $row['qty'];
                    $name1 = $row['product_name'];

                    if($qty==0){
                        echo '<tr>
                    <td>'.$name1.'</td>
                    <td>'.$category.'</td>
                    <td>0</td>
                    <td>Out of Stocks</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>';
                    }


                }
            }

            //GENERATE LOAN STATUS, LID, RID, SID RESULT
            foreach ($fetchdata1 as $key1 ){

                foreach ($key1 as $key2=>$row2){
                    $status=  $row2['status'];
                    $retailerID=  $row2['retailerID'];
                    $staffID=  $row2['staffID'];
                    $loanID=  $row2['loanID'];
                    $loanDate=  $row2['loanDate'];
                    $test= $row2['productName'];

                    foreach ($test as $key3 => $row3)
                    {
                        if ($kwordsStatus==="LOAN"||$kwordRID==$retailerID||$kwordLID==$loanID||$kwordSID==$staffID) {
                            
                            foreach ($fetchdata as $key => $row) {
                                $category = $row['category'];
                                $name = $row['product_name'];

                                if ($key3==$name){
                                    echo '<tr>
                                        <td>'.$key3.'</td>
                                        <td>'.$category.'</td>
                                        <td>'.$row3.'</td>
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


                }
            }


        }

        if (isset($_GET['startDate'])){
            //GENERATE DATE RESULT
            foreach ($fetchdata1 as $key1 ){


                foreach ($key1 as $key2=>$row2){
                    $status=  $row2['status'];
                    $retailerID=  $row2['retailerID'];
                    $staffID=  $row2['staffID'];
                    $loanID=  $row2['loanID'];
                    $loanDate=  $row2['loanDate'];
                    $test= $row2['productName'];
                    $kwordSDate = $_GET['startDate'];

                    foreach ($test as $key3 => $row3)
                    {
                        if ($kwordSDate==$loanDate) {

                            foreach ($fetchdata as $key => $row) {
                                $category = $row['category'];
                                $name = $row['product_name'];

                                if ($key3==$name){
                                    echo '<tr>
                                        <td>'.$key3.'</td>
                                        <td>'.$category.'</td>
                                        <td>'.$row3.'</td>
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

                }
            }
        }

            ?>
    </table>
</div>

<?php
include('includes/footer.php');
?>

