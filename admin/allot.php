<?php include('navbar.php'); ?>
<div class="display-table">
  <table id="myTable" class="table-show">
    <thead>
      <tr>
        <th>Project ID</th>
        <th>Project Name</th>
        <th>Student Details</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    // Change the query to fetch data from tbl_team, tbl_addproject, and tbl_student
    $faculty_id = $_SESSION['id'];

    // Change the query to fetch data from tbl_team, tbl_addproject, and tbl_student for the logged-in faculty only
    $sql = "SELECT t.project_id, a.title AS project_title, GROUP_CONCAT(CONCAT(s.id, ': ', s.name) SEPARATOR ', ') AS student_details, a.field_of_work, a.descriptionn, a.meeting_day, a.meeting_time, f.name AS faculty_name, f.email_address, f.contact_info
            FROM tbl_team t
            JOIN tbl_addproject a ON t.project_id = a.project_id
            JOIN tbl_student s ON t.student_id = s.id
            JOIN tbl_faculty f ON a.user_id = f.id
            WHERE a.user_id = '$faculty_id'  -- Filter by faculty ID
            GROUP BY t.project_id";

    
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['project_id']; ?></td>
                <td><?php echo $row['project_title']; ?></td>
                <td> <?php 
        $student_details = explode(', ', $row['student_details']);
        foreach($student_details as $detail) {
            echo $detail . "<br>"; // Output each detail on a new line
        }
        ?></td>
                <td>
                    <button id="myBtn" type="button" class="btn-floating center">
                        <i class="material-icons grey darken-1">info</i>
                    </button>
                    <div id="myModal" class="modaly">
                        <!-- Modal content -->
                        <div class="modaly-content">
                            <span class="close">&times;</span>
                            <div class="pop-up-content">
                                <h2><?php echo $row['project_title']; ?></h2>
                                <p><em><strong><?php echo $row['field_of_work']; ?></strong></em></p>
                                <br>
                                <p><?php echo $row['descriptionn']; ?></p>
                                <br>
                                <p>Meeting Day and Timmings: <?php echo $row['meeting_day'] . ' ' . $row['meeting_time']; ?></p>
                                <br>
                                <h5><?php echo $row['faculty_name']; ?></h5>
                                <p><?php echo $row['email_address']; ?> <span><?php echo $row['contact_info']; ?></span></p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
    } else {
        echo 'No records found';
    }
    ?>
    </tbody>
  </table>
</div>
<?php include('footer.php'); ?>
