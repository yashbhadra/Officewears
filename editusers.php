<?php
// Initialize the session
session_start();
include "config.php";
 
// Check if the user is logged in, if not then redirect him to login page
if((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && $_SESSION["user_role"]!= '1'){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body{ font: 14px sans-serif; background-color:white;}
        .wrapper{ max-width: 1170px; width: 660px; margin:30px auto; padding: 10px; background-color: #f2f2f2;}
        .navbar{background-color:#3a4468}
    </style>
</head>
<body>
<div class="navbar">

<a class="navbar-brand text-center text-light" href="index.php">Officewears</a>


</div>
    <div class="wrapper rounded">
        <table class='table-hover' cellpadding='10' border='1' align='center' style='width:100%'>
            <tr><th style='width:25%'>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Action</th></tr>
        <?php
        
        $sql = "SELECT * FROM User;";
        $result=mysqli_query($link, $sql);
        $count=mysqli_num_rows($result);
        
        
        
        while ($row=mysqli_fetch_array($result))
        {
            $id = $row['User_id'];
            $name = $row['User_name'];
            $address = $row['User_address'];
            $email = $row['Email'];
            $phone = $row['Phone_no'];

        
        ?>

        <tr>
            
            <td><?= $name?></td>
            <td><?= $email?></td>
            <td><?= $phone?></td>
            <td><?= $address?></td>
            <td><button class='delete' id='del_<?= $id ?>'>Delete</button>
                <button class='edit' id='edit_<?= $id ?>'>Edit</button>
            </td>
        </tr>

        <?php
        
        }
        ?>
        </table>


    
    </div>
    <script>
        $(document).ready(function{
            
            $(".delete").on("click",function(){
                var element = this;
                var id = this.id;
                
                var final_id = id.split('_');
                var deleteid = final_id[1];
        
                $.ajax({
                    url: 'deleterecord.php',
                    type: 'post',
                    data: {id:deleteid},
                    success: function(response){
                        if(response == 1){
                            $(element).closest('tr').css('background','tomato');
                            $(element).closest('tr').remove();
                        }
                        else{
                            alert('Invalid ID');
                        }
        
                    }
                });
        
            });
            
        
        });


                

    </script>
        
</body>
</html>