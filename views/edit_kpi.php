<?php require("../templates/header.php"); ?>
<br><br><br><br>
 <div id="eg-container">        
            <div id="eg-wrapper">
    <form action="../controllers/edit_kpi.php" method="POST">
        <input type="text" name="title" value="<?php echo $_POST['title'] ?? $edit_kpi->get_kpi()['title'];?>">
        <br><input type="submit" name="edit_kpi" value="Update" class="normal_button">
    </form>
</div>
</div>


<?php require("../templates/footer.php"); ?>