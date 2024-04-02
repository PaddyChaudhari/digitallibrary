<?php

require("../admin/db/db.php");
require("./security.php");

// echo "<pre>";
// print_r($_REQUEST);

if (isset($_REQUEST['new_password']) && isset($_REQUEST['current_password'])) {

    $current_password = mysqli_real_escape_string($conn, $_REQUEST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_REQUEST['new_password']);

    $admin_email = $_SESSION['email'];
    $query = "SELECT * FROM admin_data WHERE admin_email='$admin_email'";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);    

    if (mysqli_num_rows($result) > 0 && password_verify($current_password, $data['admin_password'])) {

        $password = password_hash($new_password, PASSWORD_DEFAULT);
 
        $query = "UPDATE admin_data SET admin_password = '$password' WHERE admin_email = '$admin_email'";

        mysqli_query($conn, $query);
        echo "<script> alert('Password Changed Successfully!'); window.location.href = './index.php'; </script>";
    } else {
        echo "<script> alert('Invalid Current Password!'); </script>";
    }
}



?>


<script>


    function get_current_password() {
        let current_password = prompt("Enter Current Password");

        if (current_password == null) {
            window.location.href = './index.php';
        }

        if (current_password.length > 0) {
        
            get_new_password(current_password);

        } else {
            alert("Please Enter Valid Current Password");
            get_current_password();
        }
    }


    let cn = confirm("Do you Really Want to Change the Password?");
    if (cn == true) {

        get_current_password();

    } else {
        window.location.href = './index.php';
    }



    function get_new_password(current_password) {
        let new_password = prompt("Enter New Password");


        if (new_password == null) {
            window.location.href = './index.php';
        }

        if (new_password.length > 0) {

            window.location.href = location.protocol + '//' + location.host + location.pathname + `?current_password=${current_password}&new_password=${new_password}`;

        } else {
            alert("Please Enter Valid New Password");
            get_new_password(current_password);
        }
    }
</script>