<?php include('../student/navbar-stu.php') ?>
<div class="display-table">
  <table id="myTable" class="table-show">
    <thead>
      <tr>
        <th>Project ID</th>
        <th>Project Name</th>
        <th>Faculty Name</th>
        <th>Department</th> 
        <th>Details</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
          $sql = "SELECT a.project_id, a.title AS project_title, f.name AS faculty_name, f.department, a.field_of_work, a.meeting_time, a.meeting_day, a.descriptionn, f.email_address, f.contact_info
          FROM tbl_addproject a 
          JOIN tbl_faculty f ON a.user_id = f.id
          LEFT JOIN tbl_team t ON a.project_id = t.project_id
          WHERE t.student_id IS NULL"; 
          $res = mysqli_query($conn, $sql);
          $count= mysqli_num_rows($res);
          $sn=1;
          if($count>0){
            while($row = mysqli_fetch_assoc($res)){
              $project_id =$row['project_id'];
              $project_title =$row['project_title'];
              $faculty_name =$row['faculty_name'];
              $department =$row['department'];
              ?>
              <tr>
              <td><?php echo $project_id; ?></td>
              <td><?php echo $project_title; ?></td>
              <td><?php echo $faculty_name; ?></td>
              <td><?php echo $department; ?></td>
              <td><button id="myBtn" type="button" class="btn-floating center"><i class="material-icons grey darken-1">info</i></button>
              <div id="myModal" class="modaly">
        <!-- Modal content -->
        <div class="modaly-content">
            <span class="close">&times;</span>
            <div class="pop-up-content">
              <h2><?php echo $project_title; ?></h2>
              <p><em><strong><?php echo $row['field_of_work']; ?></strong></em></p>
              <br>
              <p><?php echo $row['descriptionn']; ?></p>
              <br>
              <p>Meeting Day and Timmings: <?php echo $row['meeting_day'] . ' ' . $row['meeting_time']; ?></p>
              <br>
              <h5><?php echo $faculty_name; ?></h5>
              <p><?php echo $row['email_address']; ?> <span><?php echo $row['contact_info']; ?></span></p>
          </div>
        </div>
    </div>
                        
              </td>
            </tr>
              <?php
            }
          }
          else{
            echo 'No records found';
          }
        ?>
    </tbody>
  </table>
</div>
<?php include('../admin/footer.php'); ?>
