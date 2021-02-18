
<?php
require("../templates/header.php");
?>
<div class="border bg-light mx-auto w-50 my-5">
    <?php if($_SESSION['admin']!=false){ ?>
        <h4 ><?php echo "viewing: ".$_SESSION['email']; ?></h4>
    <?php } ?>
    <h2 class="text-center p-2 border bottom border-top-0 border-start-0 border-end-0">View Goal</h2>
        <div class="vg-card ">
            <p class="title text-center fw-bold pt-4"><?php echo $goal['name']; ?></p>

            <form action="../controllers/edit_goal.php" method="POST" >
                <input type="hidden" name="num_of_milestones_init" value="1">
                <input type="hidden" name="u_id" value="<?php echo $goal['u_id'];?>">
                <input type="hidden" name="g_id" value="<?php echo $goal['g_id'];?>">

                <p class="text-center">
                    <?php echo $goal['description']; ?>
                </p>

                <?php$i=0;?>
                <?php foreach($user_milestones as $user_milestone){ ?>
                    <?php if($goal['g_id']==$user_milestone['g_id']){  ?>
                        <input type="hidden" name="milestone[]" value="<?php echo $user_milestone['m_id'];?>">
                        <div class=" my-auto  px-2">
                                        <p class="text-center">
                                            <span class="fw-bold px-1 ">Milestone:</span> 
                                            <span class="text-muted fs-14 "><?php echo $user_milestone['name']; ?></span>
                                        </p>
                                        <p class="text-center ">
                                            <span class="fw-bold px-1 ">Start Date</span> 
                                            <span class="text-muted fs-14 "><?php echo $user_milestone['start_date']; ?></span>
                                        </p>
                                        <p class="text-center">
                                            <span class="fw-bold  px-1 ">End Date</span> 
                                            <span class="text-muted fs-14 "><?php echo $user_milestone['end_date']; ?><br><br></span>
                                        </p>
                                    </div>
                    <?php } ?>
                    <?php$i++;?>
                <?php } ?>
                <?php if($_SESSION['admin']==false){ ?>

                <input type="submit" name="edit" value="Edit Goal" class="fs-6 text-white w-100 btn bg-orange">
                <?php } ?>
            </form>
        </div>

</div>


<?php require("../templates/footer.php"); ?>