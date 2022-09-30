<?php 
   // set configue
   session_start();
   require_once "config.php";

   // set page
   $perpage = 6;
   $pageError = false;
   
   // check get page variable 
   if(isset($_GET['page'])){
      $page = $_GET['page'];
   }else{
      $page = 1;
   }

   $keyword = $optionSearch = $optionCategory = $query_order = "";
   
   // defind variable start for show start data 
   $start = ($page - 1) * $perpage;

   // initail query 
   $querySearch = "select * from book "; 

   // check search button 
   if(isset($_GET['search-button'])){

      // check get keyword 
      if(isset($_GET['keyword'])  && !empty($_GET['keyword']) ){

         // assign varrriable 
         $keyword = mysqli_real_escape_string($link, trim($_GET['keyword']));
         $optionSearch =  mysqli_real_escape_string($link, trim($_GET['option-search']));

         // set sesstion 
         $_SESSION['keyword'] = $keyword;
         $_SESSION['optionSearch'] = $optionSearch;

         // create all case iin string 
         $keyword_lowerCase = strtolower($keyword);
         $keyword_upperCase = strtolower($keyword);

         // check option  
         if($optionSearch == "author_name"){
            $querySearch = "select * from book natural join author where ( author_name like '%$keyword%' or author_name like '%$keyword_lowerCase%' or author_name like '%$keyword_upperCase%' ) ";
         }
         
         else if($optionSearch == "publish_name"){
            $querySearch = "select * from book natural join publisher where ( publisher_name like '%$keyword%' or publisher_name like '%$keyword_lowerCase%' or publisher_name like '%$keyword_upperCase%' ) " ;
         }

         else if($optionSearch == "title"){
            $querySearch = "select * from book where ( title like '%$keyword%' or title like '%$keyword_lowerCase%' or title like '%$keyword_upperCase%' ) ";
         }
         
         // check catagory 
         if(isset($_GET['option-category']) && !empty($_GET['option-category']) ){
            
            $optionCatagory =  mysqli_real_escape_string($link, trim($_GET['option-category']));

            // set sesstion 
            $_SESSION['optionCategory'] = $optionCatagory;
            
            $querySearch = $querySearch . " and category = '{$optionCatagory}'";
         
         }else{
            $_SESSION['optionCategory'] = "";
         }
      }
      // case keyword is empty 

      else if(isset($_GET['option-category']) && !empty($_GET['option-category']) ){
         $optionCategory =  mysqli_real_escape_string($link, trim($_GET['option-category']));
         // set sesstion 
         $_SESSION['keyword'] = "";
         $_SESSION['optionSearch'] = "";
         $_SESSION['optionCategory'] = $optionCategory;
         
         $querySearch = $querySearch . " where category = '{$optionCategory}'";
      }

      else{
         $_SESSION['keyword'] = "";
         $_SESSION['optionSearch'] = "";
         $_SESSION['optionCategory'] = "";
         $querySearch = "select * from book";
      }
   }

   // check order button 
   else if (isset($_GET['order-button'])){

      // assign order variable 
      $query_order = mysqli_real_escape_string($link, (trim($_GET['option-order'])));

      if($query_order == 'Charecter'){
         $order = " ORDER by title ASC ";
      }
      elseif($query_order == 'Publish_Year'){
         $order = " ORDER by publisher_years DESC ";
      }

      // check sesstion keyword 
      if(isset($_SESSION['keyword']) && !empty($_SESSION['keyword'])){

         // assign variable 
         $keyword = $_SESSION['keyword']; 
         $optionSearch = $_SESSION['optionSearch']; 

         echo "keyword -> " .$_SESSION['keyword'];
         echo "optionSearch -> " .$_SESSION['optionSearch'];

         // provide Case upper and lower charater 
         $keyword_lowerCase = strtolower($keyword);
         $keyword_upperCase = strtolower($keyword);

         // check option  
         if($optionSearch == "author_name"){
            $querySearch = "select * from book natural join author where ( author_name like '%$keyword%' or author_name like '%$keyword_lowerCase%' or author_name like '%$keyword_upperCase%' ) ";
         }
         
         else if($optionSearch == "publish_name"){
            $querySearch = "select * from book natural join publisher where ( publisher_name like '%$keyword%' or publisher_name like '%$keyword_lowerCase%' or publisher_name like '%$keyword_upperCase%' ) " ;
         }

         else if($optionSearch == "title"){
            $querySearch = "select * from book where ( title like '%$keyword%' or title like '%$keyword_lowerCase%' or title like '%$keyword_upperCase%' ) ";
         }

         // check category session 
         if(isset($_SESSION['optionCategory']) && !empty($_SESSION['optionCategory'])){

            $optionCategory = $_SESSION['optionCategory'];

            $querySearch = $querySearch . " and category = '{$optionCategory}'";

         }
      }

      // check sesstion category without sesstion keyword 
      else{
         if(isset($_SESSION['optionCategory']) && !empty($_SESSION['optionCategory'])){

            $optionCategory = $_SESSION['optionCategory'];

            $querySearch = $querySearch . " where category = '{$optionCategory}'";
         }
      }

      $querySearch = $querySearch . $order;
   }

   // without button 
   else{

      $order = "";

      if(isset($_GET['keyword'])  && !empty($_GET['keyword']) ){

         // assign varrriable 
         $keyword = mysqli_real_escape_string($link, trim($_GET['keyword']));
         $optionSearch =  mysqli_real_escape_string($link, trim($_GET['option-search']));

         // create all case iin string 
         $keyword_lowerCase = strtolower($keyword);
         $keyword_upperCase = strtolower($keyword);

         // check option  
         if($optionSearch == "author_name"){
            $querySearch = "select * from book natural join author where ( author_name like '%$keyword%' or author_name like '%$keyword_lowerCase%' or author_name like '%$keyword_upperCase%' ) ";
         }
         
         else if($optionSearch == "publish_name"){
            $querySearch = "select * from book natural join publisher where ( publisher_name like '%$keyword%' or publisher_name like '%$keyword_lowerCase%' or publisher_name like '%$keyword_upperCase%' ) " ;
         }

         else if($optionSearch == "title"){
            $querySearch = "select * from book where ( title like '%$keyword%' or title like '%$keyword_lowerCase%' or title like '%$keyword_upperCase%' ) ";
         }
         
         // check catagory 
         if(isset($_GET['option-category']) && !empty($_GET['option-category']) ){
            
            $optionCatagory =  mysqli_real_escape_string($link, trim($_GET['option-category']));

            $querySearch = $querySearch . " and category = '{$optionCatagory}'";
         
         }else{
            $_SESSION['optionCategory'] = "";
         }
      }
      
      else{
         if(isset($_GET['option-category']) && !empty($_GET['option-category']) ){
            $optionCategory =  mysqli_real_escape_string($link, trim($_GET['option-category']));
            
            $querySearch = $querySearch . " where category = '{$optionCategory}'";
         }
      }


      if(isset($_GET['order'])){
         $query_order = mysqli_real_escape_string($link, (trim($_GET['order'])));

         if($query_order == 'Charecter'){
            $order = " ORDER by title ASC ";
         }
         elseif($query_order == 'Publish_Year'){
            $order = " ORDER by publisher_years DESC ";
         }
      }

      $querySearch = $querySearch . $order;

   }

   $query  = $querySearch; 

   // provide query to limit result 
   $query = $query . " Limit {$start}, {$perpage} ";
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Library</title>

   <link rel="stylesheet" href="stylesheet.css"> 
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

<!-- content  -->
   <div class="content">

      <!-- fillter -->
      <div class="content-filter">
         
         <h1 id = "filter-title" class="filter-title">FILTER</h1>
      
         <!-- search-from  -->
         <form action="index_cus.php" class="form" method="GET" style="margin-bottom: 85px;">
            
            <!-- button -->
            <div class="div-filter-button" >
               <button  type="submit" name="search-button" value=""><h1> find </h1></button>
            </div>
            <div style="height: 20px;"></div>
            

            <!-- feature-search -->
            <h2>SEARCH</h2><br>
            <div class="filter-title-ribin"></div>
            <div class="serch-flex">
               <!-- #1 serchBox-->
               <div class="serch-flex-input" style="width: 100%; padding: 0px 20px;">
                  <h4>keyword</h4>
                  <input type="text" id="keyword" name="keyword" placeholder="search keyword" value=<?php $search ?> >
               </div>  
               <!-- #2 option-->
               <div class="option-search" class="label-oeder">
                  <h4>keyword</h4>
                  <select name="option-search">
                     <option value="title">title</option>
                     <option value="author_name">author name</option>
                     <option value="publish_name">publish name</option>
                  </select>
               </div>
            </div>
            <div style="height: 50px;"></div>

            <!-- feature-catagory -->
            <h2>Catagory</h2><br>
            <div class="filter-title-ribin"></div>
            <div class="order-flex">
               <h4>select :  </h4>
               <select name="option-category" class="option-category" >
                     <option value=""> - </option>
                     <?php
                        $query_category = "select category from book GROUP by category ORDER by category";
                        $result = mysqli_query($link, $query_category);
                        if(mysqli_num_rows($result) > 0 ){
                           while($row = mysqli_fetch_array($result)){
                     ?>
                        <option value= <?php echo $row['category'];?>> <?php echo $row['category'];?> </option>
                     <?php 
                           }
                        }
                  ?>
               </select>
            </div>
       
         </form>


      </div>
      


         <div class = "content-nav">

            <div class="feature-order-test" >
               
               <form action="index_cus.php" class="form-order" method="GET" >
                  <h2>Order by : </h2>
                  <select name="option-order">
                           <option value="Charecter">เรียงตามตัวอักษร</option>
                           <option value="Publish_Year">ปีที่พิมพ์</option>
                  </select>
                  <div>
                     <button  type="submit" name="order-button" value="order-button"><h3> find </h3></button>
                  </div>
               </form>
            </div>

         
         
         <!-- content-book  -->
         <div class="content-book">

            <!-- php loop by elemnt in database (open loop) -->
            <?php
                  if($result = mysqli_query($link, $query)){
                     if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                           
            ?> 
            
               <!-- create element -->
               <div class="content-book-frame">
                  <div class="content-book-image-fram">
                     <a href="detail.php?id= <?php echo $row['book_id'];?> " >
                        <image class="image " src= "<?php echo $row['image']?>" alt="image" height="230" style="padding: 8px 15px;"></image>
                     </a>
                  </div>

                  <div class="book-title">
                     <p class="title"><a href="detail.php?id= <?php echo $row['book_id'];?>" ><?php echo $row['title'];?></a></p>
                  </div>
               </div>

            <!-- php loop by elemnt in database (close loop) -->
            <?php 
                     }
                  }else{
                     echo "PAGE NOT FOUND";
                     $pageError = true;
                  }
               }else{
                  echo "ERROR: Could not able to execute $sql.".mysqli_error($link);
               }
            ?>

         
         </div>



         <!-- navbar-select-page  -->
         <?php 

            $sql2 = $querySearch;
            $query2 = mysqli_query($link, $sql2);
            $total_record = mysqli_num_rows($query2);
            $total_page = ceil($total_record / $perpage);
         
         ?>

         <nav class="nav-pagination">
            <ul class = pagination>

               <li>
                  <a href="index_cus.php?page=1&keyword=<?php echo $keyword;?>&option-search=<?php echo $optionSearch;?>&option-category=<?php echo $optionCategory;?>&order=<?php echo $query_order;?>"  aria-label="Previous">
                     <?php if($pageError != true){
                        ?><span>&laquo;</span> 
                     <?php } ?>
                  </a>
               </li>

               <?php for($i = 1; $i <= $total_page; $i++) { ?> 
               <li><a href="index_cus.php?page=<?php echo $i;?>&keyword=<?php echo $keyword;?>&option-search=<?php echo $optionSearch;?>&option-category=<?php echo $optionCategory;?>&order=<?php echo $query_order;?>"> <?php echo $i; ?></a></li>
               <?php
                   } 
       
               
               ?>

               <li>
                  <a href="index_cus.php?page=<?php echo $total_page ?>&keyword=<?php echo $keyword;?>&option-search=<?php echo $optionSearch;?>&option-category=<?php echo $optionCategory;?>&order=<?php echo $query_order;?>"" aria-label="Next">
                     <?php if($pageError != true){
                        ?><span>&raquo;</span> 
                     <?php } ?>
                  </a>
               </li>
            </ul>
         </nav>
      </div>
   </div>


<!-- footer  -->
   <footer>
   </footer>
   
</body>
</html>