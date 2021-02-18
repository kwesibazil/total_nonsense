    
    
    <div class="container-fluid bg-body p-2 pb-5 border shadow m-2 rounded">
        <h4>Upcoming Milestones</h4>
        <div class="d-flex flex-wrap justify-content-center ">
            <?php foreach($user_goals as $user_goal){ ?>
                <?php foreach($upcoming_milestones as $upcoming_milestone){ ?>
                    <?php if ($upcoming_milestone['g_id']==$user_goal['g_id']) {?>
                        <div class="card text-center mx-4 bg-light ">
                            <div class="card-body p-2">  
                                <div class="px-2 d-flex align-items-center">
                                    <div class=" my-auto  px-2">
                                        <p class="text-start">
                                            <span class="fw-bold px-1 ">Title:</span> 
                                            <span class="text-muted fs-14 "><?php echo $upcoming_milestone['name']; ?></span>
                                        </p>
                                        <p class="text-start">
                                            <span class="fw-bold  px-1">Goal</span> 
                                            <span class="text-muted fs-14 "><?php echo $user_goal['name']; ?></span>
                                        </p>
                                        <p class="text-start">
                                            <span class="fw-bold px-1 ">Start Date</span> 
                                            <span class="text-muted fs-14 "><?php echo $upcoming_milestone['start_date']; ?></span>
                                        </p>
                                        <p class="text-start">
                                            <span class="fw-bold  px-1 ">End Date</span> 
                                            <span class="text-muted fs-14 "><?php echo $upcoming_milestone['end_date']; ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div><!--CARD BODY ENDS-->
                        </div><!--CARD ENDS HERE-->
                    <?php } ?>
                <?php } ?>
            <?php } ?>  
        </div> <!--FLEX CONTAINER ENDS HERE-->
    </div><!--CONTAINER ENDS HERE-->

    
   

<?php require("../templates/footer.php"); ?>
