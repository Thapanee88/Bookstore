<?php
// Check existence of id parameter before processing further
if(isset($_GET["book_id"]) && !empty(trim($_GET["book_id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM book INNER JOIN author ON book.author_id = author.author_id INNER JOIN publisher ON book.publisher_id = publisher.publisher_id INNER JOIN location ON book.location_id = location.location_id WHERE book_id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_book_id);
        
        // Set parameters
        $param_book_id = trim($_GET["book_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $title = $row["title"];
                $image = $row["image"];
                $category = $row["category"];
                $detail = $row["detail"];
                $publisher_years = $row["publisher_years"];
                $author_name = $row["author_name"];
                $publisher_name = $row["publisher_name"];
                $floor = $row["floor"];
                $bookshelf = $row["bookshelf"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Book</h1>
                    <div class="form-group">
                        <label>Title</label>
                        <p><b><?php echo $row["title"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Image</label><br>
                        <img src="<?php echo $row["image"];?>">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <p><b>
                            <?php 
                                if(!empty($row['category'])) echo $row['category']; 
                                else echo " - ";
                            ?>
                        </b></p>
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <p><b>
                            <?php 
                                if(!empty($row['detail'])) echo $row['detail']; 
                                else echo " - ";
                            ?>
                        </b></p>
                    </div>
                    <div class="form-group">
                        <label>Publisher years</label>
                        <p><b><?php echo $row["publisher_years"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <p><b><?php echo $row["author_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Publisher</label>
                        <p><b><?php echo $row["publisher_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <p><b><?php echo "Floor " . $row["floor"] . " Bookshelf " . $row["bookshelf"]; ?></b></p>
                    </div>
                    <p><a href="index_admin.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>