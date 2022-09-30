<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$floor = $bookshelf = "";
$floor_err = $bookshelf_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate floor
    $input_floor = trim($_POST["floor"]);
    if(empty($input_floor)){
        $floor_err = "Please enter the floor.";     
    } elseif(!ctype_digit($input_floor)){
        $floor_err = "Please enter a positive integer value.";
    } else{
        $floor = $input_floor;
    }
    
    // Validate bookshelf
    $input_bookshelf = trim($_POST["bookshelf"]);
    if(empty($input_bookshelf)){
        $bookshelf_err = "Please enter the bookshelf.";     
    } elseif(!filter_var($input_bookshelf, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $bookshelf_err = "Please enter a valid name.";
    } else{
        $bookshelf = $input_bookshelf;
    }
    
    // Check input errors before inserting in database
    if(empty($floor_err) && empty($bookshelf_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO location (floor, bookshelf) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_floor, $param_bookshelf);
            
            // Set parameters
            $param_floor = $floor;
            $param_bookshelf = $bookshelf;
            
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
    <title>Create Location</title>
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
                    <h2 class="mt-5">Create Location</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Floor</label>
                            <input type="text" name="floor" class="form-control <?php echo (!empty($floor_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $floor; ?>">
                            <span class="invalid-feedback"><?php echo $floor_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Bookshelf</label>
                            <input type="text" name="bookshelf" class="form-control <?php echo (!empty($bookshelf_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bookshelf; ?>">
                            <span class="invalid-feedback"><?php echo $bookshelf_err;?></span>
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