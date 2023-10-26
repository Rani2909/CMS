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
        <li class="nav-item"><a href="add-contact.php" class="nav-link active">Add Contact</a></li>
      </ul>
    </header>    
    <div class="container">
        <div class="row">
            <?php
            // servername => localhost
		    // username => ranis
		    // password => Subbiah@86
		    // database name => management
                if(isset($_REQUEST['saveContact'])) {
                    $conn = mysqli_connect("localhost", "ranis", "Subbiah@86", "management");
                      // Check connection
                    if($conn === false){
                        die("ERROR: Could not connect." . mysqli_connect_error());
                    }
                    // Taking all 5 values from the form data(input)
                    $first_name = $_REQUEST['first_name'];
                    $last_name = $_REQUEST['last_name'];
                    $email = $_REQUEST['email'];
                    $phone = $_REQUEST['phone'];
                    $notes = $_REQUEST['notes'];
                    // Performing insert query execution
		            // here our table name is contact
                    $sql = "INSERT INTO 
                            contact(first_name, last_name, email, phone, notes)
                            VALUES ('$first_name', '$last_name','$email','$phone','$notes')";
                    
                    if(mysqli_query($conn, $sql)){
                        echo '<div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                                <strong>Data stored in a database successfully.</strong>
                                Please browse your localhost php my admin to view the updated data.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    } else{
                        echo '<div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                <strong>ERROR: Hush! Sorry $sql.</strong>' . mysqli_error($conn) .
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                    }
                    // Close connection
                    mysqli_close($conn);
                }
            ?>
            <div class="col-6 offset-3">
                <form action="" method="post" name="addContact">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required />
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required />
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email Address</label>
                        <input type="email" class="form-control" id="emailAddress" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phone" required />
                    </div>
                    <div class="form-group">
                        <label for="notesComments">Notes/Comments</label>
                        <textarea id="notesComments" class="form-control" name="notes" rows="4"></textarea>
                    </div>
                    <input type="submit" name="saveContact" value="Save" class="btn btn-primary">
                    <input type="reset" value="Cancel" class="btn btn-primary">
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