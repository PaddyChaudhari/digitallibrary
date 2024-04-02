<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">

</head>

<?php 

include("./db/db.php");


session_start();

if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    header("location: ./index.php");
}


$invalid_credentails = FALSE;

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = "SELECT * FROM admin_data WHERE admin_email='$email'";

    $result = mysqli_query($conn,$query);
    $data = mysqli_fetch_assoc($result);
    
    if(mysqli_num_rows($result) > 0 && password_verify($password,$data['admin_password'])){
        $_SESSION['email'] = $data['admin_email'];
        $_SESSION['password'] = $data['admin_password'];
        header("location: ./index.php");
    }else{
        $invalid_credentails = TRUE;
    }


}

?>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Admin Login</h3>
                        <form action="./login.php" method="POST" class="login-form">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control rounded-left" placeholder="Email" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
                            </div>

                            <?php 
                            
                            if($invalid_credentails){
                            
                                echo "<h3 class='text-left mb-1' style='color:red'>Invalid Credentials</h3>";
                            }
                            ?>
                        
                            <div class="form-group">
                                <button type="submit" name="login" class="btn btn-primary rounded submit p-3 px-5">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"79f97b6d0b4f6ebf","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.2.0","si":100}' crossorigin="anonymous"></script>
</body>

</html>