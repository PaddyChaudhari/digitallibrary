<?php 


require("../admin/db/db.php");

session_start();



if(isset($_POST['do_register'])){
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    // $password = mysqli_real_escape_string($conn, $_REQUEST['password']);
    $password = password_hash(mysqli_real_escape_string($conn, $_REQUEST['password']), PASSWORD_DEFAULT);


    $query = "SELECT * FROM user_data where user_email = '$email'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){
        echo "<script> alert('Account Already Exists!'); </script>";
    }else{

        $query = "INSERT INTO user_data (user_email,user_password) VALUES('$email','$password')";

        $result = mysqli_query($conn,$query);
    
        $_SESSION['user_email'] = $email;
        $_SESSION['user_password'] = $password;
        $_SESSION['user_id'] = mysqli_insert_id($conn);;
        echo "<script>
            alert('Account Created Successfully!');
            window.location.href = './index.php';

        </script>";
        // header("location:./index.php");
    }

}


?>


<!doctype html>
<html lang="en">

<head>
    <title>Login 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="./css/login.css">

    <style>
        html,body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>

    <script>
     
    </script>
</head>

<body>

<br>
<br>
<br>
<br>
<br>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Sign Up</h3>
                        <form action="./register.php" method="POST" class="login-form">
                            <div class="form-group">
                                <input type="email" class="form-control rounded-left" name="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password" placeholder="Enter Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="do_register" class="form-control btn btn-primary rounded submit px-3">Register</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>