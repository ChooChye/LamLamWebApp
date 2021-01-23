<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Manage Stock (Admin)');
$header->initHeader();


$fb = new FBconnect('includes/');
//DELETE DATA
if (isset($_POST['btnDelete'])){

    try {

        $token=$_POST['ref_token_delete'];
        $ref="Products/".$token;

        $fb->database->getReference($ref)->remove();
        echo alertSuccess(' Data has been deleted');
    }

    catch (Exception $e) {
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

    <nav class="navbar navbar-expand-lg" >
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar-text" aria-current="page" href="#">
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox_all" value="option1">
                                <label class="form-check-label" for="inlineCheckbox_all">All</label>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">

                            <button id="btnAdd" onclick="location.href='insertNewData.php'" class="btn">
                                <img src="add.svg" alt="" width="30" height="20" class="d-inline-block align-top">
                                Add
                            </button>



                    </li>

                    <li>
                      <!--  <div class="row justify-content-end">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" id="search-name" class="form-control" placeholder="Search">
                                </div>
                            </div>
                        </div>-->
                    </li>

                </ul>

            </div>
        </div>
    </nav>



    <thead>
    <tr>

        <td></td>
        <th>Product Name</th>
        <th>Category </th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Status
            <!--
            <div class="input-group" >
                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" style="border-color: transparent">
                    <option selected>Status</option>
                    <option value="1">In Stock</option>
                    <option value="2">Out of Stock</option>
                    <option value="3">Loan</option>
                </select>
            </div>
            -->
        </th>
        <th>Staff ID</th>
        <th>Retailer ID</th>
        <th>Loan ID</th>
        <th>Loan Date</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>

    <!--PRINT DATA IN PRODUCTS DATABASE-->
    <?php
    $i = 0;

    $firebase = new FBconnect('includes/');
    $prodRef="Products/";
    $fetchdata=$firebase->database->getReference($prodRef)->getValue();

    $loadRef = "Loans/";
    $fetchdata1=$firebase->database->getReference($loadRef)->getValue();

    if($fetchdata>0){

       foreach ($fetchdata  as $key=>$row  ){
            $pname = $row['product_name'];
            $category = $row['category'];
            $desc = $row['desc'];
            $price = $row['price'];
            $qty = $row['qty'];

            if ($qty>0){


         /*  echo '<tr>
                     <td>
                      <div>
                         <input type="checkbox" id="checkboxNoLabel" value="" >
                       </div>
                      </td>
                      <td>'.$pname.'</td>
                      <td>'.$category.'</td>
                      <td>'.$desc.'</td>
                      <td>'.$price.'</td>
                      <td>'.$qty.'</td>
                      <td>In Stock</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                                        <td>
                                            <form action="" method="post">
                                                <div class="form-group">
                                                   <input type="hidden" name="ref_token_delete" value="<?php echo $key?>">
                                                    <button type="submit" class="close" name="btnDelete" >
                                                        <img src="delete.svg" width="20" height="20">
                            
                                                    </button>
                            
                                                    <button type="button" class="close" name="btnEdit" onclick="location.href=\'editData.php\'" >
                                                            <a href="editData.php?token=<?php echo $key?>">
                                                            <img src="edit.svg" width="20" height="20">
                                                        </a>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        </tr>';*/

                ?>
                <tr id="currentData" class="visible">

                    <td>
                        <div>
                            <input type="checkbox" id="checkboxNoLabel" value="" >
                        </div>
                    </td>
                    <td><?php echo $pname;  ?></td>
                    <td><?php echo $category; ?></td>
                    <td><?php echo $desc; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo "In Stocks" ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="ref_token_delete" value="<?php echo $key?>">
                                <button type="submit" class="close" name="btnDelete" >
                                    <img src="delete.svg" width="20" height="20">

                                </button>

                                <button type="button" class="close" name="btnEdit" onclick="location.href='editData.php'" >
                                    <a href="editData.php?token=<?php echo $key?>">
                                        <img src="edit.svg" width="20" height="20">
                                    </a>
                                </button>
                            </div>
                        </form>
                    </td>
                    <td style="visibility: hidden"><?php echo $i; ?></td>
                </tr>

                <?php
           }elseif ($qty==0){



           ?>

             <tr id="currentData" class="visible">

                    <td>
                        <div>
                            <input type="checkbox" id="checkboxNoLabel" value="" >
                        </div>
                    </td>
                    <td><?php echo $pname;  ?></td>
                    <td><?php echo $category; ?></td>
                    <td><?php echo $desc; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo "Out of Stocks" ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="ref_token_delete" value="<?php echo $key?>">
                                <button type="submit" class="close" name="btnDelete" >
                                    <img src="delete.svg" width="20" height="20">

                                </button>

                                <button type="button" class="close" name="btnEdit" onclick="location.href='editData.php'" >
                                    <a href="editData.php?token=<?php echo $key?>">
                                        <img src="edit.svg" width="20" height="20">
                                    </a>
                                </button>
                            </div>
                        </form>
                    </td>
                    <td style="visibility: hidden"><?php echo $i; ?></td>
                </tr>


                <?php

            }

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
                        foreach ($fetchdata as $key => $row) {
                            $category = $row['category'];
                            $name = $row['product_name'];
                            $desc = $row['desc'];
                            $price = $row['price'];
                            $qty= $row['qty'];


                            if ($key3==$name){
                                echo '<tr>
                                         <td>
                                            <div>
                                                <input type="checkbox" id="checkboxNoLabel" value="" >
                                            </div>
                                        </td>
                                        <td>'.$key3.'</td>
                                         <td>'.$category.'</td>
                                        <td>'.$desc.'</td>
                                        <td>'.$price.'</td>
                                       
                                 
                                        <td>'.$row3.'</td>
                                         <td>Loans '.$status.'</td>
                                        <td>'.$staffID.'</td>
                                        <td>'.$retailerID.'</td>
                                        <td>'.$loanID.'</td>
                                        <td>'.$loanDate.'</td>
                                        <td>
                                            <form action="" method="post">
                                                <div class="form-group">
                                                   <input type="hidden" name="ref_token_delete" value="<?php echo $key?>">
                                                    <button type="submit" class="close" name="btnDelete" >
                                                        <img src="delete.svg" width="20" height="20">
                            
                                                    </button>
                            
                                                    <button type="button" class="close" name="btnEdit" onclick="location.href=\'editData.php\'" >
                            
                                                      <!--  <a href="viewproject.php?pid=\'.$row[\'pid\'].\'">-->
                                                            <a href="editData.php?token=<?php echo $key?>">
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
    else{
        ?>
        <tr>
            <td colspan="12" style="text-align: center">Data Not Available in the Firebase</td>
        </tr>
    <?php
    }
    ?>

    </tbody>
</table>
</div>

<?php
include('includes/footer.php');

?>


<?php
/*
    class crud {
        protected $database;
        protected $dbname = 'users';
        public function __construct(){
            $acc = ServiceAccount::fromJsonFile(__DIR__ . '/secret/php-firebase-7f39e-c654ccd32aba.json');
            $firebase = (new Factory)->withServiceAccount($acc)->create();
            $this->database = $firebase->getDatabase();
        }
        public function get(int $userID = NULL){
            if (empty($userID) || !isset($userID)) { return FALSE; }
            if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
                return $this->database->getReference($this->dbname)->getChild($userID)->getValue();
            } else {
                return FALSE;
            }
        }
        public function insert(array $data) {
            if (empty($data) || !isset($data)) { return FALSE; }
            foreach ($data as $key => $value){
                $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);
            }
            return TRUE;
        }
        public function delete(int $userID) {
            if (empty($userID) || !isset($userID)) { return FALSE; }
            if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
                $this->database->getReference($this->dbname)->getChild($userID)->remove();
                return TRUE;
            } else {
                return FALSE;
            }
        }

    }
*/
?>



<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-database.js"></script>

<script>



    //--------READY DATA----------
    var name,cat,description,prodPrice,quantity,prodStatus,sID,lId,lDate,rDate;

    function Ready() {
        name=document.getElementById('pname').value;
        cat=document.getElementById('pcat').value;
        description=document.getElementById('pdesc').value;
        prodPrice=document.getElementById('pprice').value;
        quantity=document.getElementById('pqty').value;
        prodStatus=document.getElementById('pstatus').value;
        sID=document.getElementById('staffID').value;
        lId=document.getElementById('loanID').value;
        lDate=document.getElementById('loanDate').value;
        rDate=document.getElementById('returnDate').value;

    }

   /* function getdata() {
        name=document.getElementById('currentName').value;
     /!*   cat=document.getElementById('currentCategory').value;
        description=document.getElementById('currentDesc').value;
        prodPrice=document.getElementById('currentPrice').value;
        quantity=document.getElementById('currentQty').value;
*!/
        firebase.database().ref('Products/'+name).on('value',function (snapshot){
            var category=snapshot.val().category;
            var desc=snapshot.val().desc;
            var price=snapshot.val().price;
            var qty=snapshot.val().qty;

            document.getElementById("currentCategory").innerHTML=category
            document.getElementById("currentDesc").innerHTML=desc
            document.getElementById("price").innerHTML=price
            document.getElementById("qty").innerHTML=qty
        }
    }*/


/*    //------INSERT------
    document.getElementById('btnAdd').onclick=function () {
        Ready();
        newRole.visible {
            visibility: visible;
        }

        firebase.database().ref('sample/'+name).set({
            product_name:name,
            category:cat,
            desc:description,
            price:prodPrice,
            qty:quantity,
            status:prodStatus,
            staff_id:sID,
            loan_id:lId,
            loan_date:lDate,
            return_date:rDate
        });
    }


    //------SELECTION------
    document.getElementById("select").onclick=function () {
        Ready();
        firebase.database().ref('sample/'+name).on('value',function (snapshot) {
           // document.getElementById('pname').value=snapshot.val().product_name;
            document.getElementById('pcat').value=snapshot.val().category;
            document.getElementById('pdesc').value=snapshot.val().desc;
            document.getElementById('pprice').value=snapshot.val().price;
            document.getElementById('pqty').value=snapshot.val().qty;
            document.getElementById('pstatus').value=snapshot.val().status;
            document.getElementById('staffID').value=snapshot.val().staff_id;
            document.getElementById('loanID').value=snapshot.val().loan_id;
            document.getElementById('loanDate').value=snapshot.val().loan_date;
            document.getElementById('returnDate').value=snapshot.val().return_date;


        });
    }

    //------UPDATE------
    document.getElementById('btnEdit').onclick=function () {
        Ready();
        firebase.database().ref('sample'+name).update({
         //   product_name:name,
            category:cat,
            desc:description,
            price:prodPrice,
            qty:quantity,
            status:prodStatus,
            staff_id:sID,
            loan_id:lId,
            loan_date:lDate,
            return_date:rDate
        });
    }

    function writeNewPost(uid, username, picture, title, body) {
        // A post entry.
        var postData = {
            author: username,
            uid: uid,
            body: body,
            title: title,
            starCount: 0,
            authorPic: picture
        };

        // Get a key for a new Post.
        var newPostKey = firebase.database().ref().child('posts').push().key;

        // Write the new post's data simultaneously in the posts list and the user's post list.
        var updates = {};
        updates['/posts/' + newPostKey] = postData;
        updates['/user-posts/' + uid + '/' + newPostKey] = postData;

        return firebase.database().ref().update(updates);
    }

    //------DELETE------
    document.getElementById('btnDelete').onclick=function () {
        Ready();
        firebase.database().ref('sample'+name).remove();
    }*/


</script>
