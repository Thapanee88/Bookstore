<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$publisher_name = $publisher_contact = "";
$publisher_name_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate publisher name
    $input_publisher_name = trim($_POST["publisher_name"]);
    if(empty($input_publisher_name)){
        $publisher_name_err = "Please enter a name.";
    } elseif(!filter_var($input_publisher_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $publisher_name_err = "Please enter a valid name.";
    } else{
        $publisher_name = $input_publisher_name;
    }
    
    // Validate publisher contact
    $publisher_contact = trim($_POST["$publisher_contact"]);
    
    // Check input errors before inserting in database
    if(empty($publisher_name_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO publisher (publisher_name, publisher_contact) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_publisher_name, $param_publisher_contact);
            
            // Set parameters
            $param_publisher_name = $publisher_name;
            $param_publisher_contact = $publisher_contact;
            
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
    <title>Create Publisher</title>
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
                    <h2 class="mt-5">Create Publisher</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="publisher_name" class="form-control <?php echo (!empty($publisher_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $publisher_name; ?>">
                            <span class="invalid-feedback"><?php echo $publisher_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <textarea name="publisher_contact" class="form-control"><?php echo $publisher_contact; ?></textarea>
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