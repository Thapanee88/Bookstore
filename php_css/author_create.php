<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$author_name = $author_contact = "";
$author_name_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        // Prepare an insert statement
        $sql = "INSERT INTO author (author_name, author_contact) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_author_name, $param_author_contact);
            
            // Set parameters
            $param_author_name = $author_name;
            $param_author_contact = $author_contact;
            
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
    <title>Create Author</title>
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
                    <h2 class="mt-5">Create Author</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="author_name" class="form-control <?php echo (!empty($author_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $author_name; ?>">
                            <span class="invalid-feedback"><?php echo $author_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <textarea name="author_contact" class="form-control"><?php echo $author_contact; ?></textarea>
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