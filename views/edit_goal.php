<?php
require("../templates/header.php");
?>
<div class="w-75 mx-auto">
    <div class="container-sm border w-50 mx-auto my-5 p-2">
        <h2 class="fs-1 py-2 text-center border-top-0 border-start-0 border-end-0 border-bottom">Edit Goal</h2>
        <form action="../controllers/edit_goal.php" method="POST" class=" d-flex flex-column justify-content-center px-4">
            <input type="submit" name="delete_goal" value="Delete Goal" class="fs-6 text-white w-100 my-2 btn bg-danger p-2 "> <!---delete goal-->

            <input type="hidden" name="g_id" value="<?php echo $edit_goal->get_goal()['g_id'];?>">
            <input class="fs-6 p-2 w-100 my-3" type="text" placeholder="name" name="name" value="<?php echo $_POST['name'] ?? $edit_goal->get_goal()['name'];?>"> <!--goal name-->
            <div name=<?php echo "goal_name_error"; ?> class="errors"><?php echo $edit_goal->get_errors()['name'] ?? "";?></div>

            <textarea  class="fs-6 w-100 my-2 p-2 " placeholder="description" rows=4 cols=22 name="description"><?php echo $_POST['description'] ?? $edit_goal->get_goal()['description']; ?></textarea>
            <div name=<?php echo "description_name_error"; ?> class="errors"><?php echo $edit_goal->get_errors()['description'] ?? "";?></div>

            <?php $j=1; ?>
            <?php for($i=0; $i<$_SESSION['num_of_milestones'];$i++){ ?>
                <?php if($_SESSION['delete_milestones'][$i]==0){ ?>
                    <input type="hidden" name="<?php echo "delete_m_id[]"; ?>" value="<?php echo $edit_goal->get_m_ids()[$i];?>">

                    <?php $j++;?>

                    <input class="fs-6 p-2 w-100 my-3" type="text" placeholder="milestone <?php echo $j; ?>" name=<?php echo "milestone_names".$i; ?> value="<?php echo $_POST["milestone_names".$i] ?? $edit_goal->get_user_milestones()[$i]['name'] ?? "";?>">
                    <div name=<?php echo "milestone_name_errors".$i; ?> class="errors"><?php echo $edit_goal->get_errors()['milestone_names'][$i] ?? "";?></div>

                    <input class="fs-6 p-2 w-100 my-3" type="date" placeholder="start date" name=<?php echo "start_dates".$i; ?> value="<?php echo $_POST["start_dates".$i] ?? $edit_goal->get_user_milestones()[$i]['start_date'] ?? "";?>">
                    <div name=<?php echo "start_date_name_errors".$i; ?> class="errors"><?php echo $edit_goal->get_errors()['start_dates'][$i] ?? "";?></div>

                    <input class="fs-6 p-2 w-100 my-3" type="date" placeholder="end date" name=<?php echo "stop_dates".$i; ?> value="<?php echo $_POST["stop_dates".$i] ?? $edit_goal->get_user_milestones()[$i]['end_date'] ?? "";?>">
                    <div name=<?php echo "stop_name_errors".$i; ?> class="errors"><?php echo $edit_goal->get_errors()['stop_dates'][$i] ?? "";?></div>

                    <input class="fs-6 text-white w-100 my-2 btn bg-danger p-2 " type="submit" name="<?php echo "delete_milestone".$i; ?>" value="Delete" class="delete">
                <?php } ?>
            <?php } ?>

            <input  class="fs-6 text-white w-100 my-3 btn bg-orange p-2 " type="submit" name="add_milestone" value="Add Milestone" class="sub_button">
            <input  class="fs-6 text-white w-100 my-3 btn bg-blue p-2 " type="submit" name="update_goal" value="Update Goal" class="normal_button">

        </form>
        <?php for($i=0; $i<$_SESSION['num_of_milestones'];$i++){ ?>

        <?php } ?>

    </div>
</div>

<?php require("../templates/footer.php"); ?>