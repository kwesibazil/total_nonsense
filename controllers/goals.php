<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Goals {
    function read(){
        $goals= select_as_assoc(get_connection(), 'goals');
        $milestones= select_as_assoc(get_connection(), 'milestones');

        $user_goals=get_user_items($goals, $milestones, 'g_id')[0];
        $user_milestones=get_user_items($goals, $milestones, 'g_id')[1];

        require('../views/goals.php');
        $this->upcoming_milestones($user_goals, $user_milestones);
    }

    function upcoming_milestones($user_goals, $user_milestones){
        $now = time();
        $upcoming_milestones=[];
        foreach($user_goals as $user_goal) {
            foreach($user_milestones as $user_milestone) {
                if ($user_milestone['g_id']==$user_goal['g_id']) {
                    $start_date = strtotime($user_milestone['start_date']);
                    $start_date = $start_date;
                    $date_diff = $start_date - $now;
                    $date_diff = round($date_diff / (60 * 60 * 24));

                    if ($date_diff <= 7) {
                        $date_diff . "<br>";
                        array_push($upcoming_milestones, $user_milestone);
                    }
                }
            }
        }

        require('../views/upcoming_milestones.php');
    }
}

$goals = new Goals;
$goals->read();
?>






