<?php
    session_start();

    include 'connection.php';
    include 'functions.php';

    // Processing form data when form is submitted
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
		$email = $_POST['email'];
        $username = $_POST['username'];
		$password_hash = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");

        if(!empty($email) && !empty($username) && !empty($password_hash) && !empty($password_confirm)){
            
            if(mysqli_num_rows($duplicate) > 0){
                echo ("<script> alert('Username or Email Already Taken'); </script>");

            } else if( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                echo("<script> alert('Valid Email is Required'); </script>");
            }else{
                if($password_hash == $password_confirm){
    
                    $user_id = random_num(6);
                    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (user_id, email, username, password_hash) VALUES('$user_id','$email','$username','$password_hash')";
    
                    mysqli_query($conn, $query);

                    echo ("<script> alert('Registration Successful'); </script>");
                    header("Location: login.php");
                    exit;

                } else {
                    echo ("<script> alert('Password does not Match'); </script>");
                }
            }

        } else{
            echo ("<script> alert('Please insert all input fields'); </script>");
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mechanic SignUp</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="center">
                <h1>SIGNUP</h1>
                <form method="post" autocomplete="off">

                    <div class="txt_field">
                        <input type="text" required name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"/>
                        <span></span>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <label>Email</label>
                    </div>

                    <div class="txt_field">
                        <input type="text" required name="username" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"/>
                        <span></span>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <label>Username</label>
                    </div>

                    <div class="txt_field">
                        <input type="password" required name="password"/>
                        <span></span>
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <label>Password</label>
                    </div>

                    <div class="txt_field">
                        <input type="password" required name="password_confirm"/>
                        <span></span>
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <label>Confirm Password</label>
                    </div>

                    <div>
                        <button type="submit" name="submit" value="signup">SIGNUP</button>
                    </div>

                    <div class="signup_link">
                        Already Have an Account? <a href="login.php">Login</a>
                    </div>
                </form>
            </div>
    </body>
</html>