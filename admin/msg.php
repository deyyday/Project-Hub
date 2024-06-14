<?php include('navbar.php'); ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["projectId"]) && !empty($_POST["messageText"])) {
        $project_id = $_POST["projectId"];
        $messagetext = $_POST["messageText"];
        $sender_id = $_SESSION['id']; 
        $insertSql = "INSERT INTO tbl_msg (project_id, message_text, sender_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertSql);

        mysqli_stmt_bind_param($stmt, "sss", $project_id, $messagetext, $sender_id);
    
        if (mysqli_stmt_execute($stmt)) {
          echo '<script>document.getElementById("messageForm").reset();</script>';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        header('location:'.SITEURL.'admin/msg.php?project_id=' . $project_id);
        exit();
    } else {
      header('location:'.SITEURL.'admin/msg.php?project_id=' . $project_id);
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
                    $faculty_id = $_SESSION['id'];
                    $sql = "SELECT t.team_id, t.project_id, GROUP_CONCAT(t.student_id SEPARATOR ', ') AS student_ids
                            FROM tbl_team t
                            WHERE t.project_id IN (
                                SELECT p.project_id
                                FROM tbl_addproject p
                                WHERE p.user_id = '$faculty_id'
                            )
                            GROUP BY t.project_id";

                    $result = mysqli_query($conn, $sql);

                    // Check if there are teams assigned to the faculty
                    if (mysqli_num_rows($result) > 0) {
                        echo '<ul class="list-unstyled mb-0">';
                        // Loop through the fetched teams and display them
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="p-2 border-bottom" data-project-id="' . $row['project_id'] . '" onclick="loadChatroom(this)">
                                    <a href= "msg.php?project_id=' . $row['project_id'] . '" class="d-flex justify-content-between" >
                                        <div class="d-flex flex-row">
                                            <div class="btn-floating center" style="margin:2px 6px 2px 2px;">
                                                <i class="material-icons grey darken-1"><img src="../assets/team-icon.png" alt="avatar" class="d-flex align-self-center me-3" width="60"></i>                              
                                                <span class="badge bg-success badge-dot"></span>
                                            </div>
                                            <div class="pt-1">
                                                <p class="fw-bold mb-0">Project ID: ' . $row['project_id'] . '</p><!-- Project ID -->
                                                <p class="small text-muted">' . $row['student_ids'] . '</p><!-- IDs of students in this team -->
                                            </div>
                                        </div>
                                        
                                    </a>
                                </li>';
                        }
                        echo '</ul>';
                    } else {
                        // If no teams are assigned to the faculty, display a message
                        echo '<p>No teams assigned.</p>';
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
                        echo '<div class="pt-3 pe-3 msgplace" data-mdb-perfect-scrollbar="true" style="position: relative; height:380px; overflow-y: auto; id="chatroom"">';

                        // Loop through the fetched messages and display them
                        while ($msg_row = mysqli_fetch_assoc($msg_result)) {
                            // Determine if the message is sent by the current user
                            $isCurrentUser = $msg_row['sender_id'] == $_SESSION['id'];

                            // Apply different styles based on whether the message is sent by the current user
                            $messageClass = $isCurrentUser ? 'text-white' : '';
                            $messageBgColor = $isCurrentUser ? 'background-color: #FFDE59;' : 'background-color: #f5f6f7;';

                            // You may need to adjust the HTML structure here based on your message content
                            echo '<div class="d-flex flex-row justify-content-' . ($isCurrentUser ? 'end' : 'start') . '">
                                <i class="material-icons primary darken-1 btn-floating center" style="width: 45px;">' . $msg_row['sender_id'] . '</i>
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
                <form id="messageForm" class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2" method="POST">
                    <i class="material-icons primary darken-1 btn-floating center" style="width: 45px;"><?php echo $_SESSION['id']; ?></i>
                    <input type="hidden" name="projectId" value="<?php echo isset($_GET['project_id']) ? $_GET['project_id'] : ''; ?>">
                    <textarea type="text" style="width: 480px; height: 80px; overflow-y: auto;" class="form-control form-control-lg" name="messageText" placeholder="Type message" class="add-input"></textarea>

                    <!-- Call the sendMessage function when the button is clicked -->
                    <button type="submit" class="btn btn-primary ms-1 text-white">Send</button>
                    <div class="TN bzz aHS-YH" style="margin-left:0px"><div class="qj qr"></div><div class="aio UKr6le"><span class="nU false"><a href="https://meet.google.com/new?hs=180&amp;authuser=0" target="_top" class="J-Ke n0" title="Start a meeting" aria-label="Start a meeting" draggable="false"><button type="button" class="btn btn-primary ms-1 text-white" onclick="confirmMeet()">Meet</button></a></span></div><div class="nL aif"></div></div>
                    
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
   function confirmMeet() {
        var confirmed = confirm("Are you sure you want to proceed with the meeting?");
        
        return confirmed; // If confirmed, form submission proceeds; otherwise, it's canceled
    }
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
