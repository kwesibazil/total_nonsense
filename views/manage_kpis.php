<?php require("../templates/header.php"); ?>
<br>
    <div class="mk-container ">
        <div class="mk-wrapper">
        <form action="../controllers/manage_kpis.php" method="POST">
           
            <h2>Manage KPIs - <?php echo date('d-F-Y');?></h2>

            <?php $i=0; ?>
            <?php foreach($this->get_user_kpis() as $kpi){ ?>
                <div  class="kpi-cards p-5">

                    

                    <h4><?php echo $kpi['title']; ?></h4>

                    0.0 <input class="rb" type="radio" name=<?php echo "score$i"; ?> value=0 <?php echo $this->check_if_checked(0, $kpi['k_id']); ?> ><br> 
                    0.5 <input class="rb"type="radio" name=<?php echo "score$i"; ?> value=0.5 <?php echo $this->check_if_checked(0.5, $kpi['k_id']); ?>><br> 
                     1.0 <input class="rb"type="radio" name=<?php echo "score$i"; ?> value=1 <?php echo $this->check_if_checked(1, $kpi['k_id']); ?>><br><br>
                    <input type="submit" class="delete bg-danger" name="delete_kpi<?php echo $i; ?>" value="Delete">


                    <?php $i++; ?>
                </div>
                <?php } ?>
            <br><input type="submit" class="normal_button" name="submit_kpi_scores" value="Submit">
        </form>
    </div>
</div>
<?php require("../templates/footer.php"); ?>