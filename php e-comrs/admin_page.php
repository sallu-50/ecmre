<?php
include ('config.php');

if(isset($_POST['add_product'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'upload image/'.$product_image;

    if(empty($product_name) || empty($product_price) || empty($product_image)){
        $messege[]='please fill out';
    }else{
        $insert = "INSERT INTO ecmrstable(name,price,image) VALUES ('$product_name','$product_price','$product_image')";
        $upload = mysqli_query($link,$insert);
        if($upload){
            move_uploaded_file($product_image_tmp_name,$product_image_folder);
            $messege[]='new product added succesfully';
        }else{
                $messege[]='could not add this product';
        }
    }
        
}
$select=mysqli_query($link,"select * from ecmrstable ");

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($link,"DELETE FROM ecmrstable WHERE id=$id");
    header('location:admin_page.php');
};


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
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
    <h1>salman</h1>
    <div class="container">
        <div class="admin-product-form-container">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post"enctype="multipart/form-data">
                <h1>Add new product</h1>
                <input type="text" placeholder="enter product name"name="product_name" class="box">
                <input type="number" placeholder="enter product price"name="product_price" class="box">
                <input type="file"accept="image/png,image/jpeg,image/jpg"name="product_image"class="box">
                <input type="submit"name="add_product"value="Add product"class="btn">
            </form>

        </div>
            
        

        <div class="display_product">
            <table class="display_product_table">
                <thead>
                    <tr>
                        <th>id</th>
                        
                        <th>product name</th>
                        <th>product price</th>
                        <th>product image</th>
                        
                        <th>action</th>
                    </tr>
                </thead>

                <tbody>
                <?php $i = 1; while  ($row= mysqli_fetch_array($select)){ ?>

                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['price'];?></td>
                    <td><img src="upload image/<?php echo $row['image']; ?> " height="100"alt=""></td>
                    <td>
                       <a href="admin_update.php?edit=<?php echo $row['id'];?>"><i class="fas fa-edit"></i>edit</a><br>
                       <a href="admin_page.php?delete=<?php echo $row['id'];?>"><i class="fas fa-trash"></i>delete</a>
                    </td>
                </tr>
                <?php $i++; }?>
            
            </tbody>
                
                
            </table>

        </div>

    </div>
</body>
</html>