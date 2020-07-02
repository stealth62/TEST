<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE tblusers SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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
    <title>Reset Password</title>

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
a:-webkit-any-link {
    cursor: pointer;
	font-size:1vw;
    text-decoration: none;
    background-color: #ff1359;
    color: white;
    padding:2% 7%;
    border: none;
    cursor: pointer;
    border-radius: 12px;
    margin-top: 0vw;
    float: left;
}
   a:-webkit-any-link :hover{
 opacity: 0.8;
    }
    </style>
</head>
<body>

    <div class="wrapper">
	
        <h2>Reset Password</h2> 
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
				
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
               <center><a href="welcome.php">Cancel</a></center>
            </div>
        </form>
    </div>    
	<div style="font-size:0.8vw;font-family:sans-serif;position:fixed;left: -42px;bottom:0;width:100%;background-color:transparent;text-align:right;color: #0000ff47;">Copyright (c) 2020, InboTech Solution by Dennis Borgs<br></br></div>
</body>
</html>