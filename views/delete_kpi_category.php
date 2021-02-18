<?php
require("../templates/header.php");
?>
<br><br><br><br>

<h2>Delete KPI Category </h2>

<form action="../controllers/delete_kpi_category.php" method="POST">

    <?php $i=0; ?>
    <?php $category_options=[]; ?>
    <?php foreach ($user_kpis as $kpi){?>
        <?php
        if($kpi['category_deleted']==0) { ?>
            <?php if(!in_array($kpi['category'],$category_options)){ ?>
                <?php array_push($category_options, $kpi['category']); ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
        <?php foreach ($category_options as $category_option){?>
            <div style="display:inline-block;" name="<?php echo "category_option$i"; ?>"><?php echo $category_option; ?></div><br>
            <input type="submit" name="<?php echo "delete_kpi_category$category_option"; ?>" value="Delete" class="delete"><br><br>

            <?php $i++; ?>
        <?php } ?>
    <br>
    <input type="submit" name="return" value="Return to Create KPI" class="sub_button"><br>
</form>

<?php require("../templates/footer.php"); ?>