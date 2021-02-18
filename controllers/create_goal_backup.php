<?php
    require('../models/connect.php');
    session_start();

class Create_Goal{
    function __construct(){
        if(!isset($_SESSION['num_of_milestones'])){
            $_SESSION['num_of_milestones']=1;
        } else if(isset($_POST['add_milestone'])) {
            $_SESSION['num_of_milestones']+=1;
        }
        if(isset($_POST['num_of_milestones_init'])){
            $_SESSION['num_of_milestones']=0;
        }

        if(isset($_POST['submit'])){
            $this->insert_goal();
            $this->insert_milestones();

            header("Location:goals.php");
            $_SESSION['num_of_milestones']=1;
        }
        require('../views/create_goal.php');
    }

    function insert_goal(){
        $u_id = $_SESSION['u_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $fields='u_id, name, description';
        $values="'$u_id','$name','$description'";
        insert(get_connection(), 'goals', $fields, $values);
    }

    function insert_milestones(){
        $goal=select_as_assoc(get_connection(), 'goals');
        $g_id=select_last(get_connection(), 'goals', 'g_id');

        for($i=1; $i<=$_SESSION['num_of_milestones'];$i++){
            $milestone_names= $_POST['milestone_names'.$i];
            $start_dates= $_POST['start_dates'.$i];
            $stop_dates= $_POST['stop_dates'.$i];

            $fields='g_id, name, start_date, end_date';
            $values="'$g_id','$milestone_names','$start_dates','$stop_dates'";
            insert(get_connection(), 'milestones', $fields, $values);
        }
    }
}

$create_goal = new Create_Goal();
?>

