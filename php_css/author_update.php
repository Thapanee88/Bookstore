<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$author_name = $author_contact = "";
$author_name_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["author_id"]) && !empty($_POST["author_id"])){
    // Get hidden input value
    $author_id = $_POST["author_id"];
    
    // Validate author name
    $input_author_name = trim($_POST["author_name"]);
    if(empty($input_author_name)){
        $author_name_err = "Please enter a name.";
    } elseif(!filter_var($input_author_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $author_name_err = "Please enter a valid name.";
    } else{
        $author_name = $input_author_name;
    }
    
    // Validate author contact
    $author_contact = trim($_POST["$author_contact"]);
    
    // Check input errors before inserting in database
    if(empty($author_name_err)){
        // Prepare an update statement
        $sql = "UPDATE author SET author_name=?, author_contact=? WHERE author_id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_author_name, $param_author_contact, $param_author_id);
            
            // Set parameters
            $param_author_name = $author_name;
            $param_author_contact = $author_contact;
            $param_author_id = $author_id;
            
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
    if(isset($_GET["author_id"]) && !empty(trim($_GET["author_id"]))){
        // Get URL parameter
        $author_id =  trim($_GET["author_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM author WHERE author_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_author_id);
            
            // Set parameters
            $param_author_id = $author_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $author_name = $row["author_name"];
                    $author_contact = $row["author_contact"];
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
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Author</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="author_name" class="form-control <?php echo (!empty($author_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $author_name; ?>">
                            <span class="invalid-feedback"><?php echo $author_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <textarea name="author_contact" class="form-control"><?php echo $author_contact; ?></textarea>
                        </div>
                        <input type="hidden" name="author_id" value="<?php echo $author_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index_admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>