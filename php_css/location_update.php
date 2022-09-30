<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$floor = $bookshelf = "";
$floor_err = $bookshelf_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["location_id"]) && !empty($_POST["location_id"])){
    // Get hidden input value
    $location_id = $_POST["location_id"];
    
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
        // Prepare an update statement
        $sql = "UPDATE location SET floor=?, bookshelf=? WHERE location_id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_floor, $param_bookshelf, $param_location_id);
            
            // Set parameters
            $param_floor = $floor;
            $param_bookshelf = $bookshelf;
            $param_location_id = $location_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["location_id"]) && !empty(trim($_GET["location_id"]))){
        // Get URL parameter
        $location_id =  trim($_GET["location_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM location WHERE location_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_location_id);
            
            // Set parameters
            $param_location_id = $location_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $floor = $row["floor"];
                    $bookshelf = $row["bookshelf"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Location</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <input type="hidden" name="location_id" value="<?php echo $location_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index_admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>