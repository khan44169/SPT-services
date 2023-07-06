<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Shopie<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="orders.php">orders</a>
         <a href="shop.php">shop</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <!-- <?php
            // $count_wishlist_items = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id = {$user_id}");

            // $total_wishlist_counts = mysqli_num_rows($count_wishlist_items);

            // $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            // $count_cart_items->execute([$user_id]);
            // $total_cart_counts = $count_cart_items->rowCount();
         ?> -->
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <!-- <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a> -->
         <!-- <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a> -->
         <!-- <div id="user-btn" class="fas fa-user"></div> -->
      </div>

      <!-- <div class="profile">
         <?php          
            // $select_profile = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id = {$user_id}");
            
            // if(mysqli_num_rows($select_profile) > 0){
            // $fetch_profile = mysqli_fetch_assoc($select_profile);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            // }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            // }
         ?>      
          -->
         
      </div>

   </section>

</header>