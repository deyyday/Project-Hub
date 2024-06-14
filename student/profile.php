<?php include('../student/navbar-stu.php') ?>

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
                        // Fetch user details based on the ID
                        $sql = "SELECT * FROM tbl_student WHERE id='$userId'";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) == 1) {
                            // User details found
                            $row = mysqli_fetch_assoc($result);
                            // Now you can use $row['column_name'] to access user details

                            // Example:
                            $name = $row['name'];
                            $year_of_graduating = $row['year_of_graduating'];
                            $department = $row['department'];
                            $skilled_at = $row['skilled_at'];
                            $email = $row['email_address'];
                            $contact = $row['contact_info'];
                            ?>
                            <h5><?php echo $name; ?></h5>
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
                        <!-- No Edit Profile option for students -->
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
                                        <label>Year of Graduating</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $year_of_graduating; ?></p>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Department</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $department; ?></p>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Skilled At</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $skilled_at; ?></p>
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
                                        <label>Contact</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $contact; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            // Use the fetched data to display user profile or perform other operations
        } else {
            // User not found
            echo "User not found.";
        }
        ?>
    </form>
</div>
</body>
</html>
