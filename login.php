<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM tblusers WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
   
<style>
form {border: none;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #768bef;
    box-sizing: border-box;
    border-radius: 12px;
}

button {
    background-color: #1371ff;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    border-radius: 12px;
}

button:hover {
  opacity: 0.8;
}

input[type="submit" i] {
	
	background-color: #1371ff;
    color: white;
    padding: 2% 7%;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    border-radius: 12px;
}
input[type="submit" i]:hover {
	opacity: 0.8;
}
 body{
	 font: 1.2vw sans-serif;
	 }
.wrapper {
    width: 480px;
    padding: 0vw 30% 0vw 30%;
}

.help-block {
    color: red;
    font-size: 1vw;
    float: right;
}

a:-webkit-any-link {
    color: #1371ff;
    cursor: pointer;
    text-decoration: none;
}

label {
color:#07902b;
}

input::placeholder {
	color:#853d1663;
	font-weight:100;
	font-size:1vw;
}

h2 {
	color:#1371ff;
}
    </style>
</head>

<body>
    <div class="wrapper">
	<p id="greeting" style="font-size: 3vw; color: #a6caff;">Good Evening</p>
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" placeholder=". . ." class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" placeholder=". . . " name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
           <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
<div style="font-size:0.8vw;font-family:sans-serif;position:fixed;left: -42px;bottom:0;width:100%;background-color:transparent;text-align:right;color: #0000ff47;">Copyright (c) 2020, InboTech Solution by Dennis Borgs<br></br></div>
</body>
<script>
        if (new Date().getHours() < 18) {
  document.getElementById("greeting").innerHTML = "Good day!";
}
</script>
</html>