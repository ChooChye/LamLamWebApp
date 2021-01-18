<?php


$fb = new FBconnect('includes/');
//$ref = "Products";

/*if (isset($_POST['update'])){
    $category=$_POST['category'];
    $desc=$_POST['desc'];
    $price=$_POST['price'];
    $product_name=$_POST['product_name'];
    $qty=$_POST['qty'];
    $token=$_POST['token'];

    $data=[
        'category'  =>$category,
        'desc'  =>$desc,
        'price'  =>$price,
        'product_name'  =>$product_name,
        'qty'  =>$qty
    ];

    $ref="Products/".$token;
    $fireb->database->getReference($ref)->update($data);
    $pushData=$fireb->database->getReference($ref)->update($data);*/
//Update product
/*if (isset($_POST['update'])) {
    $child = $_POST['category'];
    try {
        $data = [
            "category" => $child,
            "product_name" => $_POST['product_name'],
            "desc" => $_POST['desc'],
            "image" => "no_image.png",
            "qty" => $_POST['qty'],
            "price" => $_POST['price']
        ];


        $ref="Products/".$token;

         $fb->database->getReference($ref)->update($data);
        echo alertSuccess(' Data has been updated successfully');


    } catch (Exception $e) {
        echo alertError($e);
    }
}*/



?>

