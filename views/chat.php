<?php
require("../templates/header.php");
?>

<form action="../controllers/chat.php" method="POST">
 	<input type="hidden" name="<?php echo $chat->get_r_id(); ?>" value="<?php echo $chat->get_receiver(); ?>">
 	<h3><?php echo $chat->get_receiver(); ?></h3><br>

	<?php foreach($chat->get_messages() as $message){ ?>
		<?php if($message['s_id']==$_SESSION['current_u_id']){
			$class_extension="right";
		} else {
			$class_extension="left";
		}
		?>
		<div class="bubble-<?php echo $class_extension; ?>">
			<?php echo htmlspecialchars($message['message']); ?><br>
			<div class="time"><?php echo $message['time']; ?><br></div>
		</div>
	<?php } ?>

	<div class=text_area>
		<textarea class="chat my-5" rows=4 cols=22 name="message"></textarea>
	</div>
	<?php 
	$r_id=null;
		if(!isset($_POST['r_id'])){
			$r_id=$chat->get_r_id();
		} else {
			$r_id=$_POST['r_id']; 
		}
	?>

	<input type="hidden" name="r_id" value="<?php echo $r_id; ?>">
	<div class="send-container">
		<input type="submit" class="normal_button send btn btn-orange w-75" name="send_message" value="Send">
	</div>
</form>
<?php require("../templates/footer.php"); ?>