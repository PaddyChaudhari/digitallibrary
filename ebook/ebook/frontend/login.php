<?php 


require("../admin/db/db.php");

session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_password'])){
    header("location:./index.php");   
}else{

    if(isset($_POST['do_login_action'])){
        $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
        $password = mysqli_real_escape_string($conn, $_REQUEST['password']);


        $query = "SELECT * FROM user_data where user_email = '$email'";
        // $query = "SELECT * FROM user_data where user_email = '$email' AND user_password = '$password'";

        $result = mysqli_query($conn,$query);

        $data = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0 && password_verify($password,$data['user_password'])){
            $_SESSION['user_email'] = $email;
            $_SESSION['user_password'] = $password;
            $_SESSION['user_id'] = $data['user_id'];
            header("location:./index.php");
        }else{
            echo "<script> alert('Invalid Email or Password'); </script>";
        }

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
                       
                        <form action="./login.php" class="login-form" method="POST">
                            <div class="form-group">
                                <input type="email" value="<?php 
                                
                                if(isset($_POST['email'])){
                                    echo $_POST['email'];
                                }
                                
                                ?>" class="form-control rounded-left" name="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password" placeholder="Enter Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="do_login_action" class="form-control btn btn-primary rounded submit px-3">Log</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>