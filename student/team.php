<?php include('../student/navbar-stu.php') ?>
<div class="teamAdd">
    <a class="waves-effect waves-light btn darken-2 black project-add-btn" style="color: white;" href="./project.php" id="project-add" onclick="logout(event)">Show Projects</a>
    <form class="projectAdd-form" method="POST">
        <h2>Add Team</h2>
        <p>(You can only add maximum of 3 members in a group) </p>
        <br>
        <p style="font-weight: 600;  ">Enter Project Id:  <input type="text" name="project_id" style="width: 7rem;" placeholder="  Project ID" class="add-input" aria-invalid="false"> </p>
        <br><br>
        <p style="font-weight: 600;  ">Enter Teammate's Detail:  <input type="text" name="student_id[]" style="width: 7rem;" placeholder="  Student ID" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)">    <input type="text" name="student_name" style="width: 10rem;" placeholder="  Student Name" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)">    <input type="email" name="student_email" style="width: 10rem;" placeholder="  Student Email" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)"></p>
        <br><br>
        <p style="font-weight: 600;  ">Enter Teammate's Detail:  <input type="text" name="student_id[]" style="width: 7rem;" placeholder="  Student ID" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)">    <input type="text" name="student_name" style="width: 10rem;" placeholder="  Student Name" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)">    <input type="email" name="student_email" style="width: 10rem;" placeholder="  Student Email" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)"></p>
        <br><br>
        <p style="font-weight: 600;  ">Enter Teammate's Detail:  <input type="text" name="student_id[]" style="width: 7rem;" placeholder="  Student ID" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)">    <input type="text" name="student_name" style="width: 10rem;" placeholder="  Student Name" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)">    <input type="email" name="student_email" style="width: 10rem;" placeholder="  Student Email" class="add-input" aria-invalid="false" onclick="changeBackground(this)" onblur="resetStyle(this)"></p>
        <br><br>
        <input type="submit" value="Add Team" name="submit" class="waves-effect waves-light btn darken-2 project-add-btn" style="color: white; background-color: #FFDE59;">
    </form>
</div>  
<?php

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Fetch data from the form
    $project_id = $_POST['project_id'];
    $student_ids = isset($_POST['student_id']) ? $_POST['student_id'] : array();  // Assuming this is an array of student IDs
    
    // Check if all students are not already assigned to a team
    // Assuming tbl_student has a column named team_id, you need to check if it's NULL for all students
    $all_students_not_assigned = true;
    foreach($student_ids as $student_id) {
        if (!empty($student_id)) { // Check if student ID is not empty
            $check_team_query = "SELECT team_id FROM tbl_student WHERE id = '$student_id'";
            $check_team_result = mysqli_query($conn, $check_team_query);
            $row = mysqli_fetch_assoc($check_team_result);
            if ($row['team_id'] !== NULL && $row['team_id'] != 0){
                // Student already assigned to a team, set flag to false and break the loop
                $all_students_not_assigned = false;
                break;
            }
        }
    }

    if(!$all_students_not_assigned){
        // At least one student is already assigned to a team, show alert and exit
        echo '<script>alert("One or more students are already assigned to a team");</script>';
        exit;
    }

    // Proceed with adding team details to database
    $sql = "INSERT INTO tbl_team (project_id, student_id) VALUES ";
    foreach($student_ids as $student_id) {
        if (!empty($student_id)) { // Check if student ID is not empty
            $sql .= "('$project_id', '$student_id'),";
        }
    }
    $sql = rtrim($sql, ','); // Remove the trailing comma
    $res = mysqli_query($conn, $sql);
    if($res){
        // Update team_id for each student in tbl_student
        foreach($student_ids as $student_id) {
            if (!empty($student_id)) { // Check if student ID is not empty
                $update_team_query = "UPDATE tbl_student SET team_id = '$project_id' WHERE id = '$student_id'";
                mysqli_query($conn, $update_team_query);
            }
        }
  
        // Team successfully allotted, show alert
        echo '<script>alert("Project Successfully Allotted");</script>';
        exit;
    } else {
        // Failed to add team details, show alert
        echo '<script>alert("Failed to Allot Project");</script>';
        exit;
    }
}

?>


<?php include('../admin/footer.php'); ?>