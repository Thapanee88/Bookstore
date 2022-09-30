<?php
   include('config.php');
   
   if(isset($_GET['id'])) {
      $bookID = $_GET['id'];
   }
   else{
      $bookID = 1;
   }

   // find book detail from $sql 
   $sql = "SELECT * FROM book natural join author natural join  publisher  natural join  location where book_id = '$bookID'";
   $result = mysqli_query($link,$sql);
   $row = mysqli_fetch_array($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Detail</title>

   <!-- css-style-sheet -->
   <link rel="stylesheet" href="styleSheetdetail.css" >
</head>
<body>
<!-- nav-bar -->
   <div class= "header">

      <!-- nav-bar -->
      <nav > 
         <ul class="menu">
            <h1 class="logo"><a class="homepage"href="index.php">MyLibrary</a></h1>
         </ul>
      </nav>
      <!-- border-nav  -->
      <div class="border-nav"></div>

      <!-- image-header -->
      <div class="image-fram">
      </div>

   </div>
<!-- nav-bar-border -->
   <div class="border-nav"></div>


<!-- content -->
   <div class="flex-content">
      <div class="image-frame">
         <img src="<?php echo $row['image']; ?>" width="320px"></img>

         
      </div>
      <div class="content-frame">
         <!-- title -->
         <h1><?php echo $row['title']; ?></h1><br>

         <div class="content-detail">
            
            <!-- detail -->

            <p>ชื่อผู้แต่ง :  <?php echo $row['author_name']; ?></p><br>
            <p>สำนักพิมพ์ : <?php echo $row['publisher_name']; ?></p><br>
            <p>ประเภท : <?php echo $row['category']; ?></p><br>
            <p>เรื่องย่อ : <?php 
                              if(!empty($row['detail'])) echo $row['detail']; 
                              else echo " -  "; 
                        ?>      
            </p><br>
            <?php if(!empty($row['author_contact']))  { ?>  
               <p> ติดต่อ : <a href="<?php echo $row['author_contact'] ?>"> <?php echo $row['author_contact'] ?></a></p><br>
            <?php } ?>
            <p>Floor : <?php echo $row['floor']; ?></p><br>
            <p>Shelf book : <?php echo $row['bookshelf']; ?></p><br> 
            

         </div>
      </div>

   </div>



<!-- footer  -->
   <footer>
   </footer>
   
</body>
</html>