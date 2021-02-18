<?php require("../templates/header.php"); ?>
    <div>
        <br><br><br><br>

        <form action="set_kpi_scores.php" method="POST">
            <h2>Set KPIs</h2>

            <?php $i=0; ?>
            <?php foreach($user_kpis as $kpi){ ?>
                <p>Title: <?php echo $kpi['title']; ?></p>
                <input type="radio" name=<?php echo "score$i"; ?> value=0> 0
                <input type="radio" name=<?php echo "score$i"; ?> value=0.5> 0.5
                <input type="radio" name=<?php echo "score$i"; ?> value=1> 1

                <?php $today = time(); ?>
                <input type="hidden" name="today" value="<?php echo date('Y-m-d', $today);?>"><br>
                <?php $i++; ?>
            <?php } ?>
            <br><input type="submit" class="normal_button" name="submit_kpi_scores" value="Submit">
        </form>
    </div>
<?php require("../templates/footer.php"); ?>