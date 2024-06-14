<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Hub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
     <!-- Navbar Section Starts Here -->
     <section class="navbarr">
      <div class="navbarr">
          <div class="logo">
              <a href="./profile.php" title="Logo">
                  <img src="../assets/user-profile.png" alt="Site Logo" class="img-responsive">
              </a>
              
          </div>

          <div class="menu text-right" style="margin-left:180px; margin-top:5px;">
              <ul>
                  <li>
                      <a href="index.php" class="navi" >Home</a>
                  </li>
                  <li>
                      <a href="adduser.php" class="navi">Manage Users</a>
                  </li>
                  <li>
                      <a href="displayfaculty.php"class="navi" >Faculties</a>
                  </li>
                  <li>
                      <a href="displaystudent.php" class="navi">Students</a>
                  </li>
                  <li>
                      <a href="displayadmin.php" class="navi">Admins</a>
                  </li>
                  <li>
                      <a href="displayproject.php" class="navi">Projects</a>
                  </li>
              </ul>
          </div>
          <a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; float:right; margin-top:-3.5%" id="logout" onclick="logout(event)" href="../admin/index.php">Logout</a>
          <div class="clearfix"></div>
      </div>
      <hr style = 'background-color:#000000; border-width:0; color:#000000; height:2px;  display: inline-block; text-align: left; width:100%; margin-top: -7rem;' />
  </section>
  <script>
   document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll(".navi");
        links.forEach(function(link) {
            link.addEventListener("click", function() {
                links.forEach(function(el) {
                    el.classList.remove("active");
                });
                this.classList.add("active");
            });
        });
    });
</script>
