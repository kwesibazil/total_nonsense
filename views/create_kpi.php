<?php
require("../templates/header.php");
?>


<div class="w-100">
    <div class="w-100  p-0 m-0">
        <h2 class="text-center">Create KPI</h2>

        <form action="../controllers/create_kpi.php" method="POST" class=" w-75 mx-auto mt-3 p-3">
             <input type="text" placeholder="name" name="title" class="my-3 p-2"><br>
    <div name=<?php echo "title_error"; ?> class="errors"><?php echo $create_kpi->get_errors()['title'] ?? "";?></div><br>


    <?php if($new_category_field==true){ ?>
        <input type="text" class="my-2  p-2 " placeholder="category" name="category">
    <?php } else { ?>

        <?php $category_options=[]; ?>
        <?php foreach ($create_kpi->get_kpis() as $kpi){?>
                <?php
            if($kpi['category_deleted']==0) { ?>
                    <?php if(!in_array($kpi['category'],$category_options)){ ?>
                        <?php array_push($category_options, $kpi['category']); ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        <select placeholder="category" name="category" class="mt-3 px-2">
            <?php foreach ($category_options as $category_option){?>
                <option value="<?php echo $category_option; ?>"><?php echo $category_option; ?></option>
            <?php } ?>
        </select>

    <?php } ?>

    <div name=<?php echo "category_error"; ?> class="errors"><?php echo $create_kpi->get_errors()['category'] ?? "";?></div>

    <?php if($new_category_field==true){ ?>
        <br><br><input type="submit" class="my-4 bg-success text-white p-2 btn " name="preset_categories" value="Preselected">
    <?php } else { ?>
       <br><input class="my-3 bg-blue text-white p-2 btn" type="submit" class="sub_button" name="create_category" value="New Category">
    <?php } ?>

    <?php $seven_days = time() + (7 * 24 * 60 * 60); ?>
    <input type="hidden" name="start_date" value="<?php echo date('Y-m-d');?>">

    <input type="hidden" name="expiration_date" value="<?php echo date('Y-m-d', $seven_days);?>">

    <input  class="my-4 bg-danger text-white p-2 btn"  type="submit" class="delete" name="delete_category" value="Delete Category">

    <br><input type="submit" class="normal_button btn btn-orange" name="create_kpi" value="Create KPI">
</form>
    </div>




</div>
<?php require("../templates/footer.php"); ?>