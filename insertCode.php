<?php
/*session.start();
$firebase = new FBconnect('includes/');

if(isset($_POST['save_push_data'])){
    $category=$_POST['category'];
    $desc=$_POST['desc'];
 //   $image=$_POST['category'];
    $price=$_POST['price'];
    $product_name=$_POST['product_name'];
    $qty=$_POST['qty'];

    $data=[
        'category'  =>$category,
        'desc'  =>$desc,
        'price'  =>$price,
        'product_name'  =>$product_name,
        'qty'  =>$qty
    ];

    $prodRef="Products/";
    $postdata=$firebase->database->getReference($prodRef)->push($data);

    if($postdata){
        $_SESSION['status']="Data Inserted Successfully";
    }else{
        $_SESSION['status']="Data Not Inserted. Please try again";
    }
}
*/?><!--

<div class="container">
    <?php
/*        if(isset($_SESSION['status'])&& $_SESSION['status']!=""){
            */?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey</strong>
                <?php /*echo $_SESSION['status'];*/?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
       <?php
/*        unset($_SESSION['status']);
        }
    */?>
</div>
-->