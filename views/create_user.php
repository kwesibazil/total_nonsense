<?php
require("../templates/header.php");
?>

<br><br><br><br><br><br><h2>Create User</h2>

<form action="../controllers/create_user.php" method="POST">
    <input placeholder="email" type="text" name="email"><br>
    <div name=<?php echo "email_error"; ?> class="errors"><?php echo $create_user->get_errors()['email'] ?? "";?></div><br>


    <input placeholder="password" type="password" name="password"><br>
    <div name=<?php echo "password_error"; ?> class="errors"><?php echo $create_user->get_errors()['password'] ?? "";?></div><br>


    <input placeholder="confirm password" type="password" name="confirm_password"><br>
    <br><div name=<?php echo "confirm_password_error"; ?> class="errors"><?php echo $create_user->get_errors()['confirm_password'] ?? "";?></div>

   Admin Priviledges?<br>    
    yes<input class="rb" type="radio" name="admin_priv" value=1><br> 
    no<input  class="rb" type="radio" name="admin_priv" value=2>  
    <br><br><div name=<?php echo "admin_error"; ?> class="errors"><?php echo $create_user->get_errors()['admin_priv'] ?? "";?></div>


    <input type="submit" class="normal_button" name="create_user" value="Create User">
</form>
<?php require("../templates/footer.php"); ?>