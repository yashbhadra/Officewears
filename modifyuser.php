<?php
    require_once "config.php";
    $oldid = $_GET['id'];
    
    $fetch = "SELECT * FROM User WHERE User_id = '$oldid';";
    $fetch_result = mysqli_query($link,$fetch);
    $row = mysqli_fetch_array($fetch_result,MYSQLI_ASSOC);
    if($row > 0){
        $oldusername = $row['Username'];
        $oldname=$row['User_name'];
        $oldaddress=$row['User_address'];
        $oldemail=$row['Email'];
        $oldmobile=$row['Phone_no'];
    }

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    //all other variables
    $id = $_GET["id"];
    $name=$_POST["name"];
    $address=$_POST["address"];
    $email=$_POST["email"];
    $mobile=$_POST["mobile"];
    $user_role= "2";

    //TODO: Validate email and mobile variables
    
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "Update User set User_password = ?, User_name = ?, User_address = ?, Email = ?, Phone_no = ?, User_role = ? WHERE User_id='$id';";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_password, $name, $address, $email, $mobile, $user_role);
            
            // Set parameters
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_name = $name;
            $param_address = $address;
            $param_email = $email;
            $param_mobile = $mobile;
            $param_role = $user_role;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ./editusers.php");
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{ font: 14px sans-serif; background-color:white;}
        .wrapper{ max-width: 1170px; width: 660px; margin:30px auto; padding: 10px; background-color: #f2f2f2;}
        .navbar{background-color:#3a4468}
        
    </style>
</head>
<body>
    <div class="navbar navbar-expand-lg custom_nav-container">

    <a class="navbar-brand text-center text-light" href="#">Officewears</a>


    </div>
    <div class="wrapper rounded">
        <h1 class='text-center text-dark'>Edit user</h1>
        <p>Please update this form to modify details for this user.</p>
        <form action="./modifyuser.php?id=<?php echo $oldid?>" method="post">   
            <div class="form-group rounded">
            <label><i class="fa fa-key"></i> Password </label>
                <input type="password" name="password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group rounded">
            <label><i class="fa fa-key"></i> Confirm Password </label>
                <input type="password" name="confirm_password" required class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group rounded">
            <label><i class="fa fa-user"></i> Name </label>
                <input type="text" name="name" required class="form-control" value="<?php echo $oldname;?>">
                <span class="invalid-feedback"></span>
            </div>    
            <div class="form-group rounded">
            <label><i class="fa fa-address-card"></i> Address </label>
                <input type="text" name="address" required class="form-control" value="<?php echo $oldaddress; ?>">
                <span class="invalid-feedback"></span>
            </div>    
            <div class="form-group rounded">
                <label><i class="fa fa-envelope"></i> Email </label>
                <input type="text" pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' required name="email" class="form-control" value="<?php echo $oldemail; ?>">
                <span class="invalid-feedback"></span>
            </div>    
            <div class="form-group rounded">
            <label><i class="fa fa-phone"></i> Phone </label>
                <div><input type="text" name="mobile" required pattern='[4][0-9]{8}' class="form-control" value="<?php echo $oldmobile; ?>"></div>
                <span class="invalid-feedback"></span>
            </div>     
            <div class="form-group rounded">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>

