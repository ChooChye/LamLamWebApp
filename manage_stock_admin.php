<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Manage Stock (Admin)');
$header->initHeader();

?>

<?php include('includes/navbar.php') ?>
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Stocks (Admin)</h1>
    </div>

    <table class="table table-bordered">

    <nav class="navbar navbar-expand-lg >
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="navbar-text" aria-current="page" href="#">
                            <div class="form-check form-check-inline">
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



                        <!--ADD / CREATE FUNCTION-->
 <!--                       <script>
                            firebase.database().ref('prod/' + userId).set({
                                username: name,
                                email: email,
                                profile_picture : imageUrl
                            });

                            var commentsRef = firebase.database().ref('post-comments/' + postId);
                            commentsRef.on('child_added', function(data) {
                                addCommentElement(postElement, data.key, data.val().text, data.val().author);
                            });
                        </script>
-->
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
        <th>Loan ID</th>
        <th>Loan Date</th>
        <th>Return Date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>

 <!--   <tr>
        <td>
            <div>
                <input type="checkbox" id="checkboxNoLabel" value="" >
            </div>
        </td>
        <td>Blue Sweatshirt</td>
        <td>Tops</td>
        <td>Blue Sweatshirt with Hoodie</td>
        <td>RM 39.00</td>
        <td>10</td>
        <td>In Stock</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button type="button" class="close">
                <img src="delete.svg" width="20" height="20">
            </button>

            <button type="button" class="close">
                <img src="edit.svg" width="20" height="20">
            </button>
        </td>
    </tr>
    <tr>
        <td>
            <div>
                <input type="checkbox" id="checkboxNoLabel" value="" >
            </div>
        </td>
        <td>Levi's Jeans (Black)</td>
        <td>Jeans</td>
        <td>Black Levi's Jeans </td>
        <td>RM 89.00</td>
        <td>0</td>
        <td>Out of Stock</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button type="button" class="close" >
                <img src="delete.svg" width="20" height="20">
            </button>

            <button type="button" class="close">
                <img src="edit.svg" width="20" height="20">
            </button>
        </td>
    </tr>
    <tr>
        <td>
            <div>
                <input type="checkbox" id="checkboxNoLabel" value="" >
            </div>
        </td>
        <td>Pink Sweatshirt</td>
        <td>Tops</td>
        <td>Pink Sweatshirt with Hoodie</td>
        <td>RM 39.00</td>
        <td>10</td>
        <td>Loan</td>
        <td>1912121</td>
        <td>33064</td>
        <td>1/12/2020</td>
        <td>30/12/2020</td>
        <td>
            <button type="button" class="close" name="btnDelete">
                <img src="delete.svg" width="20" height="20">
            </button>

            <button type="button" class="close" name="btnEdit">
                <img src="edit.svg" width="20" height="20">
            </button>
        </td>
    </tr>-->

    <!--PRINT DATA IN PRODUCTS DATABASE-->
    <?php

    $firebase = new FBconnect('includes/');
    $prodRef="Products/";
    $returnRef="Return History/";
  //  $token = $_GET['token'];
    $fetchdata=$firebase->database->getReference($prodRef)->getValue();


    foreach ($fetchdata as $key=>$row){


    ?>
    <tr id="currentData" class="visible">
        <td>
            <div>
                <input type="checkbox" id="checkboxNoLabel" value="" >
            </div>
        </td>
        <td><label id="currentName"><?php echo $row['product_name']; ?></td>
        <td><label id="currentCategory"><?php echo $row['category']; ?></td>
        <td><label id="currentDesc"><?php echo $row['desc']; ?></td>
        <td><label id="currentPrice"><?php echo $row['price']; ?></td>
        <td><label id="currentQty"><?php echo $row['qty']; ?></td>
        <td><label id="currentStatus"><?php echo "In Stocks" ?></td>
        <td><label id="currentStaffID"></td>
        <td><label id="currentLoanID"></td>
        <td><label id="currentLoanDate"></td>
        <td><label id="currentReturnDate"></td>
        <td>
            <form action="editData.php" method="post">
                <div class="form-group">
                    <button type="button" class="close" name="btnDelete" >
                        <img src="delete.svg" width="20" height="20">

                    </button>

                    <button type="button" class="close" name="btnEdit">
                        <img src="edit.svg" width="20" height="20">
                    </button>
                </div>
            </form>
        </td>
    </tr>
    <?php

    }
    ?>
   <!-- <tr id="newRow" class="invisible">
        <td>
            <div>
                <input type="checkbox" id="checkboxNoLabel" value="" >
            </div>
        </td>
        <td><input id="pname" type="text"></td>
        <td><input id="pcat" type="text"></td>
        <td><input id="pdesc" type="text"></td>
        <td><input id="pprice" type="text"></td>
        <td><input id="pqty" type="number"></td>
        <td><input id="pstatus" type="text"></td>
        <td><input id="staffID" type="text"></td>
        <td><input id="loanID" type="text"></td>
        <td><input id="loanDate" type="date"></td>
        <td><input id="returnDate" type="date"></td>
        <td>
            <button type="button" class="close" name="btnDelete" >
                <img src="delete.svg" width="20" height="20">
            </button>

            <button type="button" class="close" name="btnEdit">
                <img src="edit.svg" width="20" height="20">
            </button>
        </td>
    </tr>-->
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
    function writeUserData(userId, name, email, imageUrl) {
        firebase.database().ref('users/' + userId).set({
            username: name,
            email: email,
            profile_picture : imageUrl
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
