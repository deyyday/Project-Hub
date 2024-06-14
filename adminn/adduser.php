<?php 
include('nav-admin.php');

if(isset($_POST['submit'])){
    if(isset($_POST['delete'])){ // Check if the delete button is clicked
        // Fetch data from the form for user deletion
        $user_id = $_POST['user_id'];
        $logintype = $_POST['logintype'];

        // Delete user from tbl_login
        $sql_delete = "DELETE FROM tbl_login WHERE user_id = '$user_id' AND logintype = '$logintype'";
        $res_delete = mysqli_query($conn, $sql_delete);

        if($res_delete){
            $_SESSION['remove'] = "<div class='success'>User Removed</div>";
        } else {
            $_SESSION['remove'] = "<div class='error'>Failed to Remove User</div>";
        }
    } else {
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        $logintype = $_POST['logintype'];

        // Check if the user already exists
        $check_user_query = "SELECT user_id FROM tbl_login WHERE user_id = '$user_id'";
        $check_user_result = mysqli_query($conn, $check_user_query);
        if(mysqli_num_rows($check_user_result) > 0){
            // User already exists, show error message
            $_SESSION['add'] = "<div class='error'>User already exists</div>";
            header('location: '.SITEURL.'adminn/index.php');
            exit;
        } else {
            $sql = "INSERT INTO tbl_login (user_id, password, logintype) VALUES ('$user_id', '$password', '$logintype')";
            
            $res = mysqli_query($conn, $sql);

            if($res){
                $_SESSION['add'] = "<div class='success'>User Added</div>";
                exit;
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add User</div>";
                exit;
            }
        }
    }
}

?>
<div class="projectAdd">
    <form class="userAdd-form" method="POST">
        <h2>Add User</h2>
        <input type="text" name="user_id"  placeholder="Enter User ID" class="add-input" aria-invalid="false">
        <br><br>
        <input type="text" name="password" placeholder="Enter Password" class="add-input" aria-invalid="false">
        <br><br>
        <input type="text" name="logintype" list="logintype"  placeholder="Enter User Type" class="add-input" aria-invalid="false">
        <datalist id="logintype">
            <option value="Admin">
            <option value="Faculty">
            <option value="Student">
        </datalist>
        <br><br>
        
        <input type="submit" value="Add User" name="submit" class="waves-effect waves-light btn darken-2 project-add-btn" style="color: white; background-color: #FFDE59;">
    </form> 
    <br><br>
    <form class="userRemover-form" method="POST">
        <h2>Delete User</h2>
        <input type="text" name="user_id"  placeholder="Enter User ID" class="add-input" aria-invalid="false">
        <br><br>
        <input type="text" name="logintype" list="logintype"  placeholder="Enter User Type" class="add-input" aria-invalid="false">
        <datalist id="logintype">
            <option value="Admin">
            <option value="Faculty">
            <option value="Student">
        </datalist>
        <br><br>
        
        <input type="submit" value="Delete User" name="delete" class="waves-effect waves-light btn darken-2 project-add-btn" style="color: white; background-color: #FFDE59;">
    </form> 
    <?php
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    } 
    if(isset($_SESSION['remove'])){
        echo $_SESSION['remove'];
        unset($_SESSION['remove']);
    }
    ?> 
    <br><br>
</div> 
</body>
</html>
