
<?php
require("../templates/header.php");
?>
    <div class="container-fluid bg-body p-2 pb-5 border shadow m-2 rounded">
        <h4 class="text-center">Goals</h4>


        <?php if($_SESSION['admin']!=false){ ?>
                    <div class="d-flex justify-content-center ">
                        <h4 class="text-center"><?php echo "viewing: ".$_SESSION['email']; ?></h4>
                    </div>
        <?php } ?>




        <div class="d-flex justify-content-end">
            <div class="p-2 ">
                <?php if($_SESSION['admin']==false){ ?>
                    <form action="../controllers/create_goal.php" method="POST">
                        <input type="hidden" name="num_of_milestones_init" value="1">
                        <input type="submit" name="create" value="Create Goal" class="btn btn-orange">
                    </form>
                <?php } ?>
            </div>  
        </div>
        <div class="d-flex flex-wrap justify-content-center ">
            <?php foreach($user_goals as $goal){ ?>
                <div class="card text-center mx-4 ">
                    <div class="card-body p-0">  
                        <div class="card-height px-2 d-flex align-items-center">
                            <div class="h-75 my-auto w-100">
                                <form action="../controllers/edit_goal.php" method="POST" class="h-100 fs-14">
                                    <input type="hidden" name="num_of_milestones_init" value="1">
                
                                    <input type="hidden" name="u_id" value="<?php echo $goal['u_id'];?>">
                                    <input type="hidden" name="g_id" value="<?php echo $goal['g_id'];?>">

                                <?php $j=0;?>
                                <?php foreach($user_milestones as $user_milestone){ ?>
                                <?php if($goal['g_id']==$user_milestone['g_id']){  ?>
                                    <?php if($j==0){ ?>
                                        <div class="">
                                            Start Date - <?php echo $user_milestone['start_date']; ?><br>
                                        </div>
                                    <?php } ?>
                                    
                                    <?php $last_date=$user_milestone['end_date']; ?>
                                        <?php $j++; ?>
                                    <?php } ?>
                
                                <?php } ?>
                
                                            <?php if($j!=0){ ?>
                                            End Date - <?php echo $last_date; ?><br>
                                            <?php } ?>
                                <?php echo $j." milestones" ;?>
                
                                </form>
                            </div>
                        </div>
                        <div class="p-0">
                            <form action="../controllers/view_goal.php" method="POST" class="">
                                <input type="submit" name="view" value="View Goal" class="fs-6 text-white w-100 m-0 btn bg-orange">
                                <input type="hidden" name="u_id" value="<?php echo $goal['u_id'];?>">
                                <input type="hidden" name="g_id" value="<?php echo $goal['g_id'];?>">
                            </form>
                        </div>
                    </div><!--CARD BODY ENDS-->
                </div><!--CARD ENDS HERE-->
            <?php } ?>   
        </div>

    </div><!--GOALS CONTAINER ENDS HERE-->




