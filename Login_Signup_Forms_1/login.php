<?php
    session_start();

    include 'connection.php';
    include 'functions.php';


    if($_SERVER['REQUEST_METHOD'] == "POST"){  //when submit button is clicked
        //something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

        if(!empty($username) && !empty($password) && !is_numeric($username)){ //checks if input fields are empty
            //read from database
			
			$query = "select * from users where username = '$username' limit 1";

			$result = mysqli_query($conn, $query);

			$user = $result->fetch_assoc();

            if ($user){
                if (password_verify($_POST["password"], $user["password_hash"])){ //verifies password hash from database
                    session_regenerate_id();
            
                    $_SESSION["username"] = $user["username"];
            
                    header("Location: index.php");
                    exit;
                }
            }
            echo ("Incorrect Username and Password");
        } else {
            echo ("Please Fill out all required fields");
        }
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Mechanic Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="center">
            <h1>LOGIN</h1>
            <form method="post" autocomplete="off">

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

                <div>
                    <button type="submit" name="submit" value="Login">LOGIN</button>
                </div>

                <div class="signup_link">
                    Don't Have an Account? <a href="signup.php">SignUp</a>
                </div>
            </form>
        </div>

    </body>
</html>