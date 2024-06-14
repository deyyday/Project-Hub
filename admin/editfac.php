<?php include('navbar.php'); ?>

<div class="emp-profile">
    <form method="post" >
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>Edit Profile</h5>
                </div>
            </div>
            <div class="col-md-5">
            <input type="submit" class="profile-edit-btn" name="btnSaveProfile" value="Save Profile"/>

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
                                <input type="text" name="userId"  value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="name" value="">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" value="">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="contact" value="">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Designation</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="designation" value="">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Department</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="department" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
if (isset($_POST['btnSaveProfile'])) {
    // Handle form submission only when "Save Profile" button is clicked

    // Your existing PHP code to update the profile details
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $userId = $_POST['userId'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $designation = $_POST['designation'];
        $department = $_POST['department'];

        // Update user details in the database
        $sql = "UPDATE tbl_faculty SET name='$name', email_address='$email', contact_info='$contact', designation='$designation', department='$department' WHERE id='$userId'";

        if (mysqli_query($conn, $sql)) {
            // Redirect back to the profile page after successful update
            echo '<script>window.location.href = "'.SITEURL.'admin/profile.php";</script>';        exit;
        } else {
            // Handle update error
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
?>

<?php include('footer.php'); ?>
