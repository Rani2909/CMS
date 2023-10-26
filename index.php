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
        <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">View Contact</a></li>
        <li class="nav-item"><a href="add-contact.php" class="nav-link">Add Contact</a></li>
      </ul>
    </header>    
    <div class="container">
        <?php
            $conn = mysqli_connect("localhost", "ranis", "Subbiah@86", "management");
            $query = "SELECT * FROM contact";
            if($conn === false){
                die("ERROR: Could not connect." . mysqli_connect_error());
            }
            if (isset($_GET['id'])) {
                $contact_id = $_GET['id'];
                $query = "DELETE FROM contact WHERE id = $contact_id";
                if(mysqli_query($conn, $query)){
                    echo '<div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                            <strong>Contact deleted in a database successfully.</strong>
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
            if (!($result = mysqli_query($conn, $query))) {
                echo 'Retrieval of data from Database Failed - #'. mysql_errno() .': '. mysql_error();
            }else{    
        ?>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Notes/Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        if (mysqli_num_rows($result) === 0){
                            echo '<tr><td colspan="6">No Rows Returned</td></tr>';
                        } else {
                            while($row = mysqli_fetch_assoc($result)){
                            echo "  <tr>
                                        <td>{$row['first_name']}</td>
                                        <td>{$row['last_name']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['phone']}</td>
                                        <td>{$row['notes']}</td>
                                        <td>
                                            <a class='btn btn-sm btn-primary mr-3' href='edit-contact.php?id={$row['id']}'>Edit</a>
                                            <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#addEditModal-{$row['id']}' data-item='{$row['id']}'>Delete</button>
                                        </td>
                                    </tr>
                                    <div class='modal fade' id='addEditModal-{$row['id']}' tabindex='-1' aria-labelledby='addEditModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h5 class='modal-title' id='addEditModalLabel'>Warning</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <form class='row needs-validation' action='' method='post' name='delete'>
                                                    <div class='col-12 mb-3'>
                                                        <label class='form-label mb-0'>Are you sure you want to delete {$row['first_name']} {$row['last_name']} from contact?</label>
                                                    </div>
                                                    <div class='col-12 border-top pt-3 text-right'>
                                                    <button type='button' class='btn btn-sm btn-secondary' data-bs-dismiss='modal'>No</button>
                                                    <a href='index.php?id={$row['id']}' name='deleteContact' class='btn btn-sm btn-danger'>Yes</button>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>";
                            }
                            $result->free();
                        } 
                    }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <small>Ambedkar Rani Subbiah &copy; 2023</small>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>


