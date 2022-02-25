<?php

include ('config.php');
$id = $_GET['edit'];

if(isset($_POST['update_product'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'upload image/'.$product_image;

    if(empty($product_name) || empty($product_price) || empty($product_image)){
        $messege[]='please fill out';
    }else{
        $update = "UPDATE ecmrstable SET name='$product_name',price='$product_price',image='$product_image' WHERE id= $id";
        $upload = mysqli_query($link,$update);
        if($upload){
            move_uploaded_file($product_image_tmp_name,$product_image_folder);
        }else{
                $messege[]='could not add this product';
        }
    }
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin update</title>
    <!-- font awesome code link-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--custom css link-->
    <link rel="stylesheet" href="styllle.css">
</head>
<body>
<?php
    if(isset($messege)){
        foreach($messege as $messege){
            echo '<span class="messege">'.$messege.'</span>';
        }
    }
    ?>
    <div class="container">

    <div class="admin-product-form-container centerd">
        <?php
        $select = mysqli_query($link,"SELECT * FROM ecmrstable WHERE id=$id");
        while($row = mysqli_fetch_assoc($select)){

        
        
        ?>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post"enctype="multipart/form-data">
                <h1>update the product</h1>
                <input type="text" placeholder="enter product name" value="<?php $row['name']; ?>"name="product_name" class="box">
                <input type="number" placeholder="enter product price" value="<?php $row['price']; ?>" name="product_price" class="box">
                <input type="file"accept="image/png,image/jpeg,image/jpg"name="product_image"class="box">
                <input type="submit"name="update_product"value="update product"class="btn">
                <a href="admin_page.php"class="btn">go back</a>
            </form>
            <?php }; ?>
        </div>

    </div>

</body>
</html>