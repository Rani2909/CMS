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
             // servername => localhost
		    // username => ranis
		    // password => Subbiah@86
		    // database name => management

                if (isset($_GET['id'])) {
                    //Connect to the database
                    $conn = mysqli_connect("localhost", "ranis", "Subbiah@86", "management");
                    $contact_id = $_GET['id'];
                    if($conn === false){
                        die("ERROR: Could not connect." . mysqli_connect_error());
                    }
                    $query = "SELECT * FROM contact WHERE id = $contact_id";
                    if (!($result = mysqli_query($conn, $query))) {
                        echo 'Retrieval of data from Database Failed - #'. mysql_errno() .': '. mysql_error();
                    }
                    if (mysqli_num_rows($result) === 0){
                        echo '<tr><td colspan="6">No Rows Returned</td></tr>';
                    } else {
                        while($row = mysqli_fetch_assoc($result)){
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $notes = $row['notes'];
                        }
                    }
                    if(isset($_REQUEST['saveContact'])) {
                        $first_name = $_REQUEST['first_name'];
                        $last_name = $_REQUEST['last_name'];
                        $email = $_REQUEST['email'];
                        $phone = $_REQUEST['phone'];
                        $notes = $_REQUEST['notes'];

                        // Performing update query execution
                        $sql = "UPDATE contact SET 
                                first_name = '$first_name',
                                last_name = '$last_name',
                                email = '$email',
                                phone = '$phone',
                                notes = '$notes'
                                WHERE id = $contact_id";
                        
                        if(mysqli_query($conn, $sql)){
                            echo '<div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                    <strong>Data updated in a database successfully.</strong>
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
                <form action="" method="post" name="editContact">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="notesComments">Notes/Comments</label>
                        <textarea id="notesComments" class="form-control" name="notes" rows="4"><?php echo $notes; ?></textarea>
                    </div>
                    <input type="submit" name="saveContact" value="Save" class="btn btn-primary">
                    <a href="index.php" class="btn btn-primary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <small>&copy; Ambedkar Rani Subbiah 2023</small>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>