<?php include('navbar.php'); ?>

<?php

// Check if the user's ID is set in the session
if(isset($_SESSION['id'])) {
  $id = $_SESSION['id']; 
  $sql = "SELECT name FROM tbl_faculty WHERE id='$id'";
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
    <p class="main-text">ADD PROJECT</p>
    <br>
    <a class="waves-effect waves-light btn darken-2 black logout-btn" style=" color: white;" href="../admin/addproject.php"  id="project" onclick="logout(event)">Projects</a>
</div>

<img src="../assets/project-img.png" class="img-main" ></img>
<?php include('footer.php'); ?>
