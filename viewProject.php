<?php


$fb = new FBconnect('includes/');
$ref = "Categories";

if (isset($_POST['update'])){
    $category=$_POST['category'];
    $desc=$_POST['desc'];
    $price=$_POST['price'];
    $product_name=$_POST['product_name'];
    $qty=$_POST['qty'];
    $ref=$_POST['ref'];

    $data=[
        'category'  =>$category,
        'desc'  =>$desc,
        'price'  =>$price,
        'product_name'  =>$product_name,
        'qty'  =>$qty
    ];

    $pushData=$fb->database->getReference('Products')->update($data);


    if(isset($_GET['pid'])){
        $dbo = new DBConnect();
        $pdo = $dbo->prepare('  SELECT P.*, PD.* 
                                    FROM projects P, project_desc PD 
                                    WHERE P.pid = PD.pid
                                    AND P.pid = :pid');
        $pdo->bindParam(':pid', $_GET['pid'], PDO::PARAM_INT);
        $pdo->execute();


        if($pdo->rowCount() == 0){
            die("<center><h3>Page Under Updating</h3><center>");
        }else{
            $row = $pdo->fetch();
        }
    }

}
?>

