
<?php
require("../templates/header.php");
?>
<br><br><br><br>
<div>

	<br><br><form action="../controllers/create_user.php" method="POST">
		<br><input type="submit" class="normal_button" name="create_a_new_user.php" value="Create User">
	</form>
<form action="../controllers/admin_panel.php" method="POST">
    <?php $i=0; ?>
    <?php foreach ($users as $user) { ?>
        <?php if ($user['admin']==0){ ?>
            <h3><?php echo $user['email']; ?></h3>
            <input type="submit" class="sub_button" name="view_user<?php echo htmlspecialchars($user['u_id']); ?>" value="View User">
            <?php $i++; ?>
        <?php } ?>
    <?php } ?>
</form>

</div>

<?php require("../templates/footer.php"); ?>
