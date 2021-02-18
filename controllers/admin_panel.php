<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Admin_Panel {
    function read(){
        $users= select_as_assoc(get_connection(), 'users');

        if($_SESSION['admin']!=false){
            $user_content = ["user_goals"=>[], "user_milestones"=>[[]]];
            $goals= select_as_assoc(get_connection(), 'goals');
            $milestones= select_as_assoc(get_connection(), 'milestones');

            foreach ($users as $user) {
                $user_goals = get_user_items($goals, $milestones, 'g_id')[0];
                $user_milestones = get_user_items($goals, $milestones, 'g_id')[1];
            }
            require('../views/admin_panel.php');

        }
    }

    function view_user($users){
        $i=0;
        foreach ($users as $user){
            if(isset($_POST["view_user".$user['u_id']])){
                $_SESSION['u_id']=$user['u_id'];
                $_SESSION['email']=$user['email'];
                header("Location:goals.php");
            }
        }
    }
}
$users= select_as_assoc(get_connection(), 'users');
$admin_panel = new Admin_Panel();
$admin_panel->view_user($users);
$admin_panel->read();

?>






