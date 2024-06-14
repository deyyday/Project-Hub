<?php include('navbar.php'); ?>

<div class=" emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-1">
                
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                <?php


// Check if the user's ID is set in the session
if(isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    // Assuming you have established a database connection

    // Fetch user details based on the ID
    $sql = "SELECT * FROM tbl_faculty WHERE id='$userId'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        // User details found
       while( $row = mysqli_fetch_assoc($result)){
        // Now you can use $row['column_name'] to access user details
        
        // Example:
        $name = $row['name'];
        $designation = $row['designation'];
        $department = $row['department'];
        $email = $row['email_address'];
        $contact = $row['contact_info'];
        ?>
                    <h5><?php echo $name; ?></h5>
                    <h6><?php echo $designation; ?></h6>
                    <br>
                    <br>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5">
               <a href="./editfac.php" class="profile-edit-btn btn" style="background-color: white;">Edit Profile </a> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-6">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>User Id</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $userId; ?></p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $name; ?></p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $email; ?></p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $contact; ?></p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Designation</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $designation; ?></p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Department</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $department; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>

        <?php
        }
       }
        // Use the fetched data to display user profile or perform other operations
    } else {
        // User not found
        echo "User not found.";
    }

?>
