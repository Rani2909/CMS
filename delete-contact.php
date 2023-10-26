<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management system</title>
    <link rel='stylesheet' type='text/css' href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="d-flex flex-wrap py-2 mb-4 border-bottom">
      <a href="index.php" class="d-flex align-items-start mr-auto text-white text-decoration-none">
        <h2 class="mb-0 mx-3">CMS</h2>
        <span class="fs-4 pt-2 mb-0 mt-1">Contact Management System</span>
      </a>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">View Contact</a></li>
        <li class="nav-item"><a href="add-contact.php" class="nav-link">Add Contact</a></li>
      </ul>
    </header>    
    <div class="container">
        <div class="row">
        <?php

                            
                if (isset($_GET['id'])) {

                    //Connect to the database
                    $conn = mysqli_connect("localhost", "ranis", "Subbiah@86", "management");
                    $contact_id = $_GET['id'];
                    //Check connection
                    if($conn === false){
                        die("ERROR: Could not connect." . mysqli_connect_error());
                    }
                    if (isset($_POST['delete'])) {
                // Delete the contact from the database

                $sql = "DELETE FROM contact WHERE id = '$contact_id'";

                if(mysqli_query($conn, $sql)){
                    echo '<div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                            <strong>Data deleted in a database successfully.</strong>
                            Please browse your localhost php my admin to view the updated data.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    header( "refresh:3;url=index.php" );
                } else{
                    echo '<div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                            <strong>ERROR: Hush! Sorry $sql.</strong>' . mysqli_error($conn) .
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            }
            // Close connection
            mysqli_close($conn);
        } else {
            echo "No contact ID provided.";
            exit;
        }
            ?>
            <div class="col-6 offset-3">
                <form action="" method="post" name="deleteContact">
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete a Contact</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete-contact.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <input type="submit" name="deleteContact" value="Yes" class="btn btn-danger">
                          <a class="btn" href="index.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>