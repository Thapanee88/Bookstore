<?php
// Include config file
require_once "config.php";

// mysql select query for select
$option_author = "SELECT * FROM `author`";
$option_publisher = "SELECT * FROM `publisher`";
$option_location = "SELECT * FROM `location`";

// option author publisher location
$result_option_author = mysqli_query($link, $option_author);
$result_option_publisher = mysqli_query($link, $option_publisher);
$result_option_location = mysqli_query($link, $option_location);
 
// Define variables and initialize with empty values
$title = $image = $category = $detail = $publisher_years = "";
$title_err = $image_err = $publisher_years_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title.";
    } else{
        $title = $input_title;
    }

    // Validate image
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter a URL image.";
    } else{
        $image = $input_image;
    }
    
    // Category do not need validate
    $category = trim($_POST["category"]);

    // Detail do not need validate
    $detail = trim($_POST["detail"]);

    // Validate publisher years
    $input_publisher_years = trim($_POST["publisher_years"]);
    if(empty($input_publisher_years)){
        $publisher_years_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_publisher_years)){
        $publisher_years_err = "Please enter a positive integer value.";
    } else{
        $publisher_years = $input_publisher_years;
    }
    
    // Validate author
    $author_id = $_POST['author_id'];

    // Validate publisher
    $publisher_id = $_POST['publisher_id'];

    // Validate location
    $location_id = $_POST['location_id'];

    // Check input errors before inserting in database
    if(empty($title_err) && empty($image_err) && empty($publisher_years_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO book (title, image, category, detail, publisher_years, author_id, publisher_id, location_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssiii", $param_title, $param_image, $param_category, $param_detail, $param_publisher_years, $param_author_id, $param_publisher_id, $param_location_id);
            
            // Set parameters
            $param_title = $title;
            $param_image = $image;
            $param_category = $category;
            $param_detail = $detail;
            $param_publisher_years = $publisher_years;
            $param_author_id = $author_id;
            $param_publisher_id = $publisher_id;
            $param_location_id = $location_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index_admin.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Book</title>
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
                    <h2 class="mt-5">Create Book</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="text" name="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $image; ?>">
                            <span class="invalid-feedback"><?php echo $image_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" value="<?php echo $category; ?>">
                        </div>
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea name="detail" class="form-control"><?php echo $detail; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Publisher years</label>
                            <input type="text" name="publisher_years" class="form-control <?php echo (!empty($publisher_years_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $publisher_years; ?>">
                            <span class="invalid-feedback"><?php echo $publisher_years_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Author</label>
                            <select name="author_id" class="custom-select">
                                <option selected>-- Open this select menu --</option>
                                <?php while($author = mysqli_fetch_array($result_option_author)):;?>
                                    <option value="<?php echo $author[0];?>"><?php echo $author[1];?></option>
                                <?php endwhile;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Publisher</label>
                            <select name="publisher_id" class="custom-select">
                                <option selected>-- Open this select menu --</option>
                                <?php while($publisher = mysqli_fetch_array($result_option_publisher)):;?>
                                    <option value="<?php echo $publisher[0];?>"><?php echo $publisher[1];?></option>
                                <?php endwhile;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <select name="location_id" class="custom-select">
                                <option selected>-- Open this select menu --</option>
                                <?php while($location = mysqli_fetch_array($result_option_location)):;?>
                                    <option value="<?php echo $location[0];?>"><?php echo "Floor " . $location[1] . " bookshelf " . $location[2];?></option>
                                <?php endwhile;?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index_admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>