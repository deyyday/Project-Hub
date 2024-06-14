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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" href="/assets/favicon/index.png" type="image/gif">
</head>

<body>

    <h3 class="center" style="color: #FFDE59;">Welcome To The PROJECT HUB</h3>
    <main class="login-card">
        <div class="card white">
            <span class="card-title center black">
                <h4>Login</h4>
            </span>
             <br>
            <div class="card-content">
                <form action="" method="POST">
                    <div>
                        <input id="loginid" name="id" type="text" placeholder="Offical ID">
                    </div>
                    <div>
                        <input id="loginpassword" name="password" type="password" placeholder="Password">
                    </div>
                    
                    <div>
                    <input id="logintype"  placeholder="User Type" list="user" name="user">
                    <datalist id="user" >
                        <option value="Admin">
                        <option value="Faculty">
                        <option value="Student">
                        </datalist>
                    </div>
                    <br>
                    
                    <div class="center"> 
                        <input type="submit" name="submit" value="Login" class="waves-effect waves-light btn black darken-2 ">
                    </div>
                </form>
            </div>
            </div>
        </div>
        
    </main>
    <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        } 
    ?> 
    <!-- <script src="scripts/auth.js"></script> -->
</body>

</html>
<?php
    if(isset($_POST['submit'])){
        // Process for Login
        
        $id = $_POST['id']; 
        $password = ($_POST['password']);
        $logintype = $_POST['user']; // Added to capture user type

        // Assuming you have established a database connection
        // Also, make sure to sanitize user inputs to prevent SQL injection

        // Construct SQL query based on login type
        $sql = "SELECT * FROM tbl_login WHERE user_id='$id' AND password='$password'";
        if ($logintype == 'Faculty') {
            $sql = "SELECT * FROM tbl_login WHERE user_id='$id' AND password='$password'";
        } elseif ($logintype == 'Student') {
            $sql = "SELECT * FROM tbl_login WHERE user_id='$id' AND password='$password'";
        }
// After successful login
$_SESSION['id'] = $id; // Set the user's ID in the session


        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        // $userId=$_POST['userId'];
        if ($count == 1){
            // User available and login success
            $_SESSION['login'] = "<div class='center success'>Login Successful.</div>";

            // Redirect to appropriate page based on login type
            if ($logintype == 'Admin') {
                header('location:'.SITEURL.'adminn/index.php?id=' . $id);
            } elseif ($logintype == 'Faculty') {
                header('location:'.SITEURL.'admin/admin.php?id=' . $id);
            } elseif ($logintype == 'Student') {
                header('location:'.SITEURL.'student/index.php?id=' . $id);
            }
            exit; // Stop further execution
            // After successful login
        } else {
            // User not available or login fail
            $_SESSION['login'] = "<div class='center error'>Login fail.</div>";
            header('location:'.SITEURL.'admin/index.php'); // Redirect to login page
            exit; // Stop further execution
        }
    }
?>
