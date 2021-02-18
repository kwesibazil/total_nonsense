<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class View_Goal {
    function read(){
        $g_id=$_POST['g_id'];
        $goal=select_row(get_connection(), 'goals', 'g_id', $g_id);

        $milestones= select_as_assoc(get_connection(), 'milestones');
        $user_milestones=get_user_items([$goal], $milestones, 'g_id')[1];

        require('../views/view_goal.php');
    }
}

$view_goal = new View_Goal;
$view_goal->read();
?>






