<?php include('../student/navbar-stu.php') ?>
<?php
if(isset($_SESSION['id'])) {
  $id = $_SESSION['id']; 
  $sql = "SELECT name FROM tbl_student WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        // User details found
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];}// Retrieve the user's ID from the session
}  else {
    // Handle the case where the user's ID is not set in the session
    // You may redirect the user to a login page or perform other actions
    echo "User's ID is not set in the session.";
}
?>
<div class="content">
  <?php echo '<h1 style="color: #FFDE59;">Hi ' . $name . ' 👋</h1>';?>
<BR>
    <p class="main-text">SHOW PROJECT</p>
    
    <a class="waves-effect waves-light btn darken-2 black logout-btn" style=" color: white;" href="/project-hub/student/project.php"  id="project" >Projects</a>
  </div>
  <img src="../assets/project-img.png" class="img-main" >
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

