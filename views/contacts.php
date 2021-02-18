<?php
require("../templates/header.php");
?>

<br><br><br><br>


<h2 class="contact-div">Contacts</h2><br>

<form action="../controllers/chat.php" method="POST">
  <?php $i=0; ?>  
  <?php foreach($contacts->get_contacts() as $contact){ ?>
       	 
       	<div class="contact-div">
	        <input type="submit" class="contact"
	         name="<?php echo $contacts->get_contact_ids()[$i]; ?>" 
	         value="<?php echo $contact; ?>"><br>
	    </div>
        <?php $i++; ?>
  
  <?php } ?>
</form>
<?php require("../templates/footer.php"); ?>