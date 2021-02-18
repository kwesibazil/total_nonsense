<?php
require("../templates/header.php");
?>


    <div class=" w-100 p-0 bg-light d-flex justify-content-center">
        <div class="bg-body w-75  my-auto p-5 py-3">
            <div class="mb-2">
                <h3 class="fs-1 text-center ">Create Goal</h3>
            </div>

            <div class=" ">
                <form action="../controllers/goals.php" method="POST" class=" d-flex justify-content-center my-4">
                    <input type="submit" name="cancel" value="Cancel" class="fs-6 text-white w-25 btn bg-success ">
                </form>

                <form action="../controllers/create_goal.php" method="POST"  class=" d-flex flex-column justify-content-center my-4 mx-6 " >
                    <div class=" w-100  mx-auto">

                        <div class="mb-3  d-flex justify-content-center">
                            <input class="w-100 p-2"  type="text" placeholder="name" name="name" value="<?php echo $_POST['name']??""; ?>">
                            <div name=<?php echo "goal_name_error"; ?> class="errors"><?php echo $create_goal->get_errors()['name'] ?? "";?></div>
                        </div>
                        <div class="mb-3 d-flex justify-content-center ">
                            <textarea class="w-100" placeholder="description" rows=4 cols=22 name="description"><?php echo $_POST['description']??""; ?></textarea>
                            <div name=<?php echo "description_name_error"; ?> class="errors"><?php echo $create_goal->get_errors()['description'] ?? "";?></div>
                        </div>

                        <div class="mb-3 d-flex flex-column justify-content-center ">
                            <?php $j=1; ?>
                            <?php for($i=0; $i<$_SESSION['num_of_milestones'];$i++){ ?>
                                <?php if($_SESSION['delete_milestones'][$i]==0){ ?>
                                    <input type="hidden" name="<?php echo "delete_m_id[]"; ?>" value="<?php echo $m_ids[$i];?>">

                                    <input class="p-2"placeholder="milestone <?php echo $i+1; ?>" type="text" name=<?php echo "milestone_names".$i; ?> value="<?php echo $_POST["milestone_names".$i] ?? $user_milestones[$i]['name'] ?? "";?>">
                                   
                                    <div name=<?php echo "milestone_name_errors".$i; ?> class="errors"><?php echo $create_goal->get_errors()['milestone_names'][$i] ?? "";?></div><br>
                                    <input  class="p-2"placeholder="start date"type="date" name=<?php echo "start_dates".$i; ?> value="<?php echo $_POST["start_dates".$i] ?? $user_milestones[$i]['start_date'] ?? "";?>">
                                    <div name=<?php echo "start_date_name_errors".$i; ?> class="errors"><?php echo $create_goal->get_errors()['start_dates'][$i] ?? "";?></div><br>
                                    <input  class="p-2" placeholder="end date" type="date" name=<?php echo "stop_dates".$i; ?> value="<?php echo $_POST["stop_dates".$i] ?? $user_milestones[$i]['end_date'] ?? "";?>">
                                    <div name=<?php echo "stop_name_errors".$i; ?> class="errors"><?php echo $create_goal->get_errors()['stop_dates'][$i] ?? "";?></div><br>                  
                                    <input type="submit" class="p-2 bg-danger"name="<?php echo "delete_milestone".$i; ?>" value="Delete" class="delete"><br><br>
                                <?php } ?>
                            <?php } ?>
                        </div>



                        <div class="mb-3 d-flex justify-content-center">
                            <input type="submit" class="w-100 p-2 btn btn-orange" name="add_milestone" value="Add Milestone" class="sub_button"><br>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <input type="submit"class="w-100 p-2 btn btn-blue"  name="create_goal" value="Create Goal" class="normal_button"><br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--CONTAINER ENDS HERE-->

    <?php for($i=0; $i<$_SESSION['num_of_milestones'];$i++){ ?>
<?php } ?>
<?php require("../templates/footer.php"); ?>
