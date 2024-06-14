<?php include('navbar-stu.php'); ?>

<section style="background-color: #FFDE59; margin-top:-25px; height:90vh;">
  <div class="container py-5">

    <div class="row">
      <div class="col-md-12">

        <div class="card" id="chat3" style="border-radius: 15px;">
          <div class="card-body">

            <div class="row">
              <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

                <div class="p-3">
                <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
<?php
$student_id = $_SESSION['id'];

// Fetch the project details including all student IDs and faculty ID
$sql = "SELECT t.project_id, GROUP_CONCAT(t.student_id) AS student_ids, p.user_id AS faculty_id
        FROM tbl_team t
        INNER JOIN tbl_addproject p ON t.project_id = p.project_id
        WHERE t.project_id IN (
            SELECT project_id
            FROM tbl_team
            WHERE student_id = '$student_id'
        )
        GROUP BY t.project_id";
$result = mysqli_query($conn, $sql);

// Check if a project is assigned to the student
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $project_id = $row['project_id'];
        $student_ids = $row['student_ids'];
        $faculty_id = $row['faculty_id'];

        // Display the project details
        echo '<ul class="list-unstyled mb-0">';
        echo '<li class="p-2 border-bottom" data-project-id="' . $project_id . '" onclick="loadChatroom(this)">
                <a href= "msg.php?project_id=' . $project_id . '" class="d-flex justify-content-between" >
                    <div class="d-flex flex-row">
                        <div class="btn-floating center" style="margin:2px 6px 2px 2px;">
                            <i class="material-icons grey darken-1"><img src="../assets/team-icon.png" alt="avatar" class="d-flex align-self-center me-3" width="60"></i>                              
                            <span class="badge bg-success badge-dot"></span>
                        </div>
                        <div class="pt-1">
                            <p class="fw-bold mb-0">Project ID: ' . $project_id . '</p><!-- Project ID -->
                            <p class="small text-muted">Student IDs: ' . $student_ids . '</p><!-- Student IDs -->
                            <p class="small text-muted">Faculty ID: ' . $faculty_id . '</p><!-- Faculty ID -->
                        </div>
                    </div>
                    <div class="pt-1">
                        <p class="small text-muted mb-1">Just now</p>
                        <span class="badge rounded-pill float-end" style="background-color: #FFDE59;">3</span>
                    </div>
                </a>
            </li>';
        echo '</ul>';
    }
} else {
    // If no project is assigned to the student, display a message
    echo '<p>No project assigned.</p>';
}
?>


                  </div>

                </div>

              </div>
              <?php include('msg.php'); ?>
