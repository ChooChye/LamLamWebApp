<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Manage Stock (Admin)');
$header->initHeader();


$fb = new FBconnect('includes/');
//DELETE DATA
if (isset($_POST['btnDelete'])) {

    try {

        $token = $_POST['ref_token_delete'];
        $ref = "Products/" . $token;

        $fb->database->getReference($ref)->remove();
        echo alertSuccess(' Data has been deleted');

    } catch (Exception $e) {
        echo alertError($e);
    }
}

?>

<?php include('includes/navbar.php') ?>
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Stocks </h1>
    </div>

    <table class="table table-bordered">

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">

                            <button id="btnAdd" onclick="location.href='insertNewData.php'" class="btn">
                                <img src="add.svg" alt="" width="30" height="20" class="d-inline-block align-top">
                                Add
                            </button>

                        </li>

                        <li>
                            <div class="row justify-content-end">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <form method="get" action="">
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" name="search" class="form-control"
                                                           placeholder="Search">
                                                </div>

                                                <div class="col">
                                                    <input type="submit" class="btn btn-primary" name="btnsearch" value="Search"/>

                                                    <a href="manage_stock_admin.php" class="btn btn-outline-secondary">Reset</a>
                                                </div>
                                            </div>


                                        </form>

                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>


        <thead>
        <tr>

            <th>Product Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Status
            </th>
            <th>Staff ID</th>
            <th>Retailer ID</th>
            <th>Loan ID</th>
            <th>Loan Date</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>

        <?php

        $firebase = new FBconnect('includes/');
        $prodRef = "Products/";
        $fetchdata = $firebase->database->getReference($prodRef)->getValue();

        $loadRef = "Loans/";
        $fetchdata1 = $firebase->database->getReference($loadRef)->getValue();

        if (isset($_GET['search'])) {
            $kword = strtoupper($_GET['search']);

            //PRINT DATA AFTER SEARCH
            foreach ($fetchdata as $key => $row) {

                $name = strtoupper($row['product_name']);
                $nameForGUI = $row['product_name'];
                $category = $row['category'];
                $desc = $row['desc'];
                $price = $row['price'];
                $qty = $row['qty'];

                if (stripos($name, $kword) !== false) {

                        ?>

                        <tr id="currentData" class="visible">

                            <td><?php echo $nameForGUI; ?></td>
                            <td><?php echo $category; ?></td>
                            <td><?php echo $desc; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php
                            if ($qty > 0) {
                                echo "In Stocks" ;
                            } elseif ($qty == 0) {
                                echo "Out of Stocks";
                             }
                                ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="ref_token_delete" value="<?php echo $key ?>">
                                        <button type="submit" class="close" name="btnDelete">
                                            <img src="delete.svg" width="20" height="20">

                                        </button>

                                        <button type="button" class="close" name="btnEdit"
                                                onclick="location.href='editData.php'">
                                            <a href="editData.php?token=<?php echo $key ?>">
                                                <img src="edit.svg" width="20" height="20">
                                            </a>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>


                        <?php
                }
            }

            foreach ($fetchdata1 as $key1) {

                foreach ($key1 as $key2 => $row2) {
                    $status = $row2['status'];
                    $retailerID = $row2['retailerID'];
                    $staffID = $row2['staffID'];
                    $loanID = $row2['loanID'];
                    $loanDate = $row2['loanDate'];
                    $test = $row2['productName'];

                    foreach ($test as $key3 => $row3) {
                        foreach ($fetchdata as $key => $row) {
                            $category = $row['category'];
                            $loanname = $row['product_name'];
                            $loanname1 = strtoupper($row['product_name']);
                            $desc = $row['desc'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            if (stripos($loanname1, $kword) !== false) {
                                if ($key3 == $loanname) {
                                    echo '<tr>
                                         
                                        <td>' . $key3 . '</td>
                                         <td>' . $category . '</td>
                                        <td>' . $desc . '</td>
                                        <td>' . $price . '</td>
                                       
                                 
                                        <td>' . $row3 . '</td>
                                         <td>Loans ' . $status . '</td>
                                        <td>' . $staffID . '</td>
                                        <td>' . $retailerID . '</td>
                                        <td>' . $loanID . '</td>
                                        <td>' . $loanDate . '</td>
                                        <td>
                                            <form action="" method="post">
                                                <div class="form-group">
                                                   <input type="hidden" name="ref_token_delete" value="<?php echo $key?>">
                                                    <button type="submit" class="close" name="btnDelete" >
                                                        <img src="delete.svg" width="20" height="20">
                            
                                                    </button>
                            
                                                    <button type="button" class="close" name="btnEdit" onclick="location.href=\'editData.php\'" >
                                                               
                                                            <a href='.$key3.'>
                                                            <img src="edit.svg" width="20" height="20">
                                                        </a>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        </tr>';
                                }
                            }


                        }
                    }

                }
            }

        }else{

            //PRINT DATA DIRECTLY
            if ($fetchdata > 0) {

                foreach ($fetchdata as $key => $row) {

                    $pname = $row['product_name'];
                    $category = $row['category'];
                    $desc = $row['desc'];
                    $price = $row['price'];
                    $qty = $row['qty'];

                    ?>
                        <tr id="currentData" class="visible">

                            <td><?php echo $pname; ?></td>
                            <td><?php echo $category; ?></td>
                            <td><?php echo $desc; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php
                        if ($qty > 0) {
                                echo "In Stocks";
                        } elseif ($qty == 0) {
                            echo "Out of Stocks";
                        }
                            ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="ref_token_delete" value="<?php echo $key ?>">
                                        <button type="submit" class="close" name="btnDelete">
                                            <img src="delete.svg" width="20" height="20">

                                        </button>

                                        <button type="button" class="close" name="btnEdit"
                                                onclick="location.href='editData.php'">
                                            <a href="editData.php?token=<?php echo $key ?>">
                                                <img src="edit.svg" width="20" height="20">
                                            </a>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                        <?php
                }

                foreach ($fetchdata1 as $key1) {

                    foreach ($key1 as $key2 => $row2) {
                        $status = $row2['status'];
                        $retailerID = $row2['retailerID'];
                        $staffID = $row2['staffID'];
                        $loanID = $row2['loanID'];
                        $loanDate = $row2['loanDate'];
                        $test = $row2['productName'];

                        foreach ($test as $key3 => $row3) {
                            foreach ($fetchdata as $key => $row) {
                                $category = $row['category'];
                                $name = $row['product_name'];
                                $desc = $row['desc'];
                                $price = $row['price'];
                                $qty = $row['qty'];


                                if ($key3 == $name) {
                                    echo '<tr>
                                        
                                        <td>' . $key3 . '</td>
                                         <td>' . $category . '</td>
                                        <td>' . $desc . '</td>
                                        <td>' . $price . '</td>
                                                 
                                        <td>' . $row3 . '</td>
                                         <td>Loans ' . $status . '</td>
                                        <td>' . $staffID . '</td>
                                        <td>' . $retailerID . '</td>
                                        <td>' . $loanID . '</td>
                                        <td>' . $loanDate . '</td>
                                        <td>
                                            <form action="" method="post">
                                                <div class="form-group">
                                                   <input type="hidden" name="ref_token_delete" value="<?php echo $key?>">
                                                    <button type="submit" class="close" name="btnDelete" >
                                                        <img src="delete.svg" width="20" height="20">
                            
                                                    </button>
                            
                                                    <button type="button" class="close" name="btnEdit" onclick="location.href=\'editData.php\'" >
                                                                                
                                                            <a href="editData.php?name='.$key3.'">
                                                            <img src="edit.svg" width="20" height="20">
                                                        </a>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        </tr>';
                                }

                            }
                        }

                    }
                }
            } else {
                ?>
                <tr>
                    <td colspan="12" style="text-align: center">Data Not Available in the Firebase</td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>

<?php
include('includes/footer.php');
?>



