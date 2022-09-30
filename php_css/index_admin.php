<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Admin Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <!-- table book -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Book Details</h2>
                        <a href="book_create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Book</a>
                    </div>
                    <?php
                    // include config file
                    require_once "config.php";
                    
                    // select query execution
                    $sql = "SELECT `book_id`, `title`, `publisher_years` FROM `book`";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Publisher_years</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['book_id'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['publisher_years'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="book_read.php?book_id='. $row['book_id'] .'" class="mr-3" title="View" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="book_update.php?book_id='. $row['book_id'] .'" class="mr-3" title="Update" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="book_delete.php?book_id='. $row['book_id'] .'" title="Delete" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No data were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    ?>
                </div>
            </div>        
        </div>
    </div>
    <!-- table author -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Author Details</h2>
                        <a href="author_create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Author</a>
                    </div>
                    <?php
                    // select query execution
                    $sql = "SELECT * FROM author";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo '<th>#</th>';
                                        echo '<th>Name</th>';
                                        echo '<th>Contact</th>';
                                        echo '<th>Action</th>';
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['author_id'] . "</td>";
                                        echo "<td>" . $row['author_name'] . "</td>";
                                        echo "<td>" . $row['author_contact'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="author_read.php?author_id='. $row['author_id'] .'" class="mr-3" title="View" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="author_update.php?author_id='. $row['author_id'] .'" class="mr-3" title="Update" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="author_delete.php?author_id='. $row['author_id'] .'" title="Delete" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No data were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    ?>
                </div>
            </div>        
        </div>
    </div>
    <!-- table publisher -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Publisher Details</h2>
                        <a href="publisher_create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Publisher</a>
                    </div>
                    <?php
                    // select query execution
                    $sql = "SELECT * FROM publisher";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo '<th>#</th>';
                                        echo '<th>Name</th>';
                                        echo '<th>Contact</th>';
                                        echo '<th>Action</th>';
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['publisher_id'] . "</td>";
                                        echo "<td>" . $row['publisher_name'] . "</td>";
                                        echo "<td>" . $row['publisher_contact'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="publisher_read.php?publisher_id='. $row['publisher_id'] .'" class="mr-3" title="View" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="publisher_update.php?publisher_id='. $row['publisher_id'] .'" class="mr-3" title="Update" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="publisher_delete.php?publisher_id='. $row['publisher_id'] .'" title="Delete" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No data were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    ?>
                </div>
            </div>        
        </div>
    </div>
    <!-- table location -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Location Details</h2>
                        <a href="location_create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Location</a>
                    </div>
                    <?php
                    // select query execution
                    $sql = "SELECT * FROM location";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo '<th>#</th>';
                                        echo '<th>Floor</th>';
                                        echo '<th>Bookshelf</th>';
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['location_id'] . "</td>";
                                        echo "<td>" . $row['floor'] . "</td>";
                                        echo "<td>" . $row['bookshelf'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="location_read.php?location_id='. $row['location_id'] .'" class="mr-3" title="View" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="location_update.php?location_id='. $row['location_id'] .'" class="mr-3" title="Update" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="location_delete.php?location_id='. $row['location_id'] .'" title="Delete" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No data were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>