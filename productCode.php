<?php
session.start();
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