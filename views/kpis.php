
    <div>

    <?php if($_SESSION['admin']==false){ ?>
        <form action="../controllers/create_kpi.php" method="POST">
            <br><input type="submit" name="to_create_kpi" value="Create KPI" class="normal_button">
        </form>

        <form action="../controllers/manage_kpis.php" method="POST">
            <input type="hidden" name="delete_init">
            <input type="submit" name="manage_kpis" value="Manage KPIs" class="normal_button">
        </form>
    <?php } else { ?>
            <h4><?php echo "viewing: ".$_SESSION['email']; ?></h4>
    <?php } ?>
    </div>


<?php require("../templates/footer.php"); ?>