<?php include('navbar.php'); ?>
<div class="display-table">
  <table id="myTable" class="table-show">
    <thead>
      <tr>
        <th>Faculty ID</th>
        <th>Project Name</th>
        <th>Faculty Name</th>
        <th>Department</th> 
        <th>Details</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
    $sql = "SELECT a.user_id, a.title AS project_title, f.name AS faculty_name, f.department, a.field_of_work, a.meeting_time, a.meeting_day, a.descriptionn, f.email_address, f.contact_info 
            FROM tbl_addproject a 
            JOIN tbl_faculty f ON a.user_id = f.id";
    $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            // Generate unique IDs for each row
            $btn_id = 'myBtn_' . $row['user_id'];
            $modal_id = 'myModal_' . $row['user_id'];
            ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['project_title']; ?></td>
                <td><?php echo $row['faculty_name']; ?></td>
                <td><?php echo $row['department']; ?></td>
                <td>
                    <button id="<?php echo $btn_id; ?>" type="button" class="btn-floating center"><i class="material-icons grey darken-1">info</i></button>
                    <div id="<?php echo $modal_id; ?>" class="modaly">
                        <!-- Modal content -->
                        <div class="modaly-content">
                            <span class="close">&times;</span>
                            <div class="pop-up-content">
                                <h2><?php echo $row['project_title']; ?></h2>
                                <p><em><strong><?php echo $row['field_of_work']; ?></strong></em></p>
                                <br>
                                <p><?php echo $row['descriptionn']; ?></p>
                                <br>
                                <p>Meeting Day and Timings: <?php echo $row['meeting_day'] . ' ' . $row['meeting_time']; ?></p>
                                <br>
                                <h5><?php echo $row['faculty_name']; ?></h5>
                                <p><?php echo $row['email_address']; ?> <span><?php echo $row['contact_info']; ?></span></p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <script>
    // JavaScript to handle modal display
    document.getElementById('<?php echo $btn_id; ?>').onclick = function() {
        var modal = document.getElementById('<?php echo $modal_id; ?>');
        modal.style.display = "block";

        // Close the modal when the close button is clicked
        modal.querySelector(".close").onclick = function() {
            modal.style.display = "none";
        };
    }
</script>
            <?php
        }
     
    ?>
    </tbody>
  </table>
</div>
<?php include('footer.php'); ?>
