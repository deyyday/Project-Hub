<?php 
include('navbar.php');
 // Start the session
?>
<?php 
if(isset($_POST['submit'])){
    // Fetch data from the form
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $department = $_POST['department'];
    $title = $_POST['title'];
    $field_of_work = isset($_POST['field_of_work']) ? $_POST['field_of_work'] : '';
    $descriptionn = isset($_POST['descriptionn']) ? $_POST['descriptionn'] : '';
    $meeting_day = $_POST['meeting_day'];
    $meeting_time = $_POST['meeting_time'];
    $check_user_query = "SELECT user_id FROM tbl_login WHERE user_id = '$user_id'";
    $check_user_result = mysqli_query($conn, $check_user_query);

    if(mysqli_num_rows($check_user_result) > 0){
        // Insert data into tbl_addproject
        $sql = "INSERT INTO tbl_addproject (user_id, title, department, field_of_work, descriptionn, meeting_day, meeting_time) 
                VALUES ('$user_id', '$title', '$department', '$field_of_work', '$descriptionn', '$meeting_day', '$meeting_time')";
        
        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['add'] = "<div class='success'>Project Added</div>";
            header('location: '.SITEURL.'admin/display.php'); // Redirect after successful insertion
            exit;
        } else {
            $_SESSION['add'] = "<div class='error'>Failed to Add Project</div>";
            header('location: '.SITEURL.'admin/addproject.php'); // Redirect if insertion fails
            exit;
        }
    } else {
        $_SESSION['add'] = "<div class='error'>User ID does not exist</div>";
        header('location: '.SITEURL.'admin/addproject.php'); // Redirect if user_id doesn't exist
        exit;
    }
}
?>
<div class="projectAdd">
    <a class="waves-effect waves-light btn darken-2 black project-add-btn" style="color: white;" href="../admin/display.php" id="project-add" onclick="logout(event)">Show Projects</a>
    <form class="projectAdd-form" method="POST">
        <h2>Add Project</h2>
        <input type="text" name="user_id" style="width: 7rem;" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>" placeholder="  Your Official ID" class="add-input" aria-invalid="false">
        <br><br>
        <input type="text" name="department" list="department" style="width: 7rem;" placeholder="  Department" class="add-input" aria-invalid="false">
        <datalist id="department">
            <option value="CSE">
            <option value="IT">
            <option value="CCE">
            <option value="IOT">
            <!-- Add more options if needed -->
        </datalist>
        <br><br>
        <input type="text" name="title" placeholder="Title Of The Project" class="add-input" aria-invalid="false">
        <br><br>
        <input type="text" name="field_of_work" placeholder="Field Of Work (e.g., Data Science)" class="add-input" aria-invalid="false">
        <br><br>
        <textarea name="descriptionn" placeholder="Description Of Project (Mention requirements, goals, outcomes, approach)" class="add-input" style="height: 18rem;" aria-invalid="false"></textarea>
        <br><br>
        <input type="text" name="meeting_day" placeholder="Day & time for meetings (Write the day which you would like to schedule for project meetings)" class="add-input" aria-invalid="false" style="width: 1000px;">
        <input type="time" name="meeting_time" style="width: 150px; margin-left: 20px;" class="add-input" aria-invalid="false">
        <br><br>
        <input type="submit" value="Add Project" name="submit" class="waves-effect waves-light btn darken-2 project-add-btn" style="color: white; background-color: #FFDE59;">
    </form> 
    <?php
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    } 
    ?> 
    <br><br>
</div> 
</body>
</html>

