<?php include('navbar-stu.php'); ?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are provided
    if (!empty($_POST["projectId"]) && !empty($_POST["messageText"])) {
        // Get the values from the form
        $project_id = $_POST["projectId"];
        $messagetext = $_POST["messageText"];
        $sender_id = $_SESSION['id']; // Get the session ID

        // Prepare the SQL statement
        $insertSql = "INSERT INTO tbl_msg (project_id, message_text, sender_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertSql);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sss", $project_id, $messagetext, $sender_id);
    
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Message inserted successfully
            echo '<script>document.getElementById("messageForm").reset();</script>';

            // Reload the page using JavaScript
        } else {
            // Error inserting message
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    } else {
        // All fields are required
        echo "All fields are required.";
    }
}
?>
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
                            <p class="small text-muted">Student IDs: ' . $student_ids . ' Faculty ID: ' . $faculty_id . '</p><!-- Student IDs -->
                        </div>
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

              <div class="col-md-6 col-lg-7 col-xl-8 chatroom">
              <?php
                // Fetch messages based on the received project ID
                if (isset($_GET['project_id'])) {
                  $projectId = $_GET['project_id'];

                  // Fetch messages from tbl_msg for the specified project ID
                  $msg_sql = "SELECT * FROM tbl_msg WHERE project_id = '$projectId'";
                  $msg_result = mysqli_query($conn, $msg_sql);

                  // Check if there are messages for the project
                  if (mysqli_num_rows($msg_result) > 0) {
                    echo '<div class="pt-3 pe-3 msgplace" data-mdb-perfect-scrollbar="true" style="position: relative; height:380px; overflow-y: auto;" >';

                    // Loop through the fetched messages and display them
                    while ($msg_row = mysqli_fetch_assoc($msg_result)) {
                      // Determine if the message is sent by the current user
                      $isCurrentUser = $msg_row['sender_id'] == $_SESSION['id'];

                      // Apply different styles based on whether the message is sent by the current user
                      $messageClass = $isCurrentUser ? 'text-white' : '';
                      $messageBgColor = $isCurrentUser ? 'background-color: #FFDE59;' : 'background-color: #f5f6f7;';

                      // You may need to adjust the HTML structure here based on your message content
                      echo '<div class="d-flex flex-row justify-content-' . ($isCurrentUser ? 'end' : 'start') . '">
                      <i class="material-icons primary darken-1 btn-floating center" style="width: auto; font-size: 20px;">' . $msg_row['sender_id'] . '</i>

                        <div>
                          <p class="small p-2 me-3 mb-1 rounded-3 ' . $messageClass . '" style="' . $messageBgColor . '">' . $msg_row['message_text'] . '</p>
                          <p class="small me-3 mb-3 rounded-3 text-muted float-end">' . $msg_row['sent_at'] . '</p>
                        </div>
                      </div>';
                    }
                    echo '</div>';
                  } else {
                    echo '<p>No messages available for this project.</p>';
                  }
                }
                ?>
                <form class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2" method="POST">
  <i class="material-icons primary darken-1 btn-floating center" style="width: 45px;"><?php echo $_SESSION['id']; ?></i>
  <input type="hidden" name="projectId" value="<?php echo isset($_GET['project_id']) ? $_GET['project_id'] : ''; ?>">
  <textarea type="text" style="width: 580px; height: 80px; overflow-y: auto;" class="form-control form-control-lg" name="messageText" placeholder="Type message" class="add-input"></textarea>
  <!-- Call the sendMessage function when the button is clicked -->
  <button type="submit" class="btn btn-primary ms-1 text-white">Send</button>
</form>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>
</section>
</div>
</div>
<script>
  window.onload = function() {
    var chatroom = document.querySelector('.msgplace');
    chatroom.scrollTop = chatroom.scrollHeight;
  };
  function loadChatroom(projectId) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.querySelector('.chatroom').innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "msg.php?project_id=" + projectId, true);
  xhttp.send();
}
</script>

