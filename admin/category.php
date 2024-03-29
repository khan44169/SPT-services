<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_category'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);   
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../category_images/'.$image_01;

   $select_products =mysqli_query($conn,"SELECT * FROM categories WHERE category = '$name';");
   // $select_products->execute([$name]);

   if(mysqli_num_rows($select_products)> 0){
      $message[] = 'category is already exist!';
   }else{

      $insert_products = mysqli_query($conn,"INSERT INTO `categories`(category, category_image) VALUES ('$name','$image_01')");
      // $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);
      echo(mysqli_error($conn));

      if($insert_products){
         if($image_size_01 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            $message[] = 'new category added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `category` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   $delete_product = $conn->prepare("DELETE FROM `category` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Categories</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">Add Category</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Category name (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="Enter category name" name="name">
         </div>
        <div class="inputBox">
            <span>image (required)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>Category details (required)</span>
            <textarea name="details" placeholder="Enter category details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="Add Category" class="btn" name="add_category">
   </form>

</section>

<!-- <section class="show-products">

   <h1 class="heading">Category added</h1>

   <div class="box-container">

   <?php
      $select_products = mysqli_query($conn,"SELECT * FROM `category`");
   
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_products = mysqli_fetch_assoc($select_products)){ 
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="details"><span><?= $fetch_products['details']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this category?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no category added yet!</p>';
      }
   ?>
   
   </div>

</section> -->


<script src="../js/admin_script.js"></script>
   
</body>
</html>