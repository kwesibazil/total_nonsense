<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Edit_Goal{
    private $m_ids;
    private $g_id;
    private $goal;
    private $user_milestones;
    private $errors;

    function __construct(){
        $this->m_ids=[];
        $this->errors=['name'=>null,'description'=>'','milestone_names'=>[], 'start_dates'=>[],'stop_dates'=>[]];

        if(isset($_POST['edit'])) {
            $_SESSION['delete_milestones']=[];
            if(isset($_POST['milestone'])){
                foreach ($_POST['milestone'] as $m_id) {
                    array_push($_SESSION['delete_milestones'], 0);
                }
            }
        }

        $this->g_id=$_POST['g_id'];
        $this->goal=select_row(get_connection(), 'goals', 'g_id', $this->g_id);

        $milestones= select_as_assoc(get_connection(), 'milestones');
            $this->user_milestones=get_user_items([$this->goal], $milestones, 'g_id')[1];

        foreach($this->user_milestones as $user_milestone){
            array_push($this->m_ids, $user_milestone['m_id']);
        }
    }

    function insert_goal($g_id){
        $u_id = $_SESSION['u_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $fields=['u_id', 'name', 'description'];
        $values=["'$u_id'","'$name'", "'$description'"];
        insert_where(get_connection(), 'goals', $fields, $values, 'g_id', $g_id);
    }

    function delete_goal($goal)
    {
        if (isset($_POST['delete_goal'])) {
            delete_where(get_connection(), 'goals', 'g_id', $goal['g_id']);
            header("Location:goals.php");
        }
    }

    function delete_milestones(){
        for($i=0; $i<$_SESSION['num_of_milestones'];$i++) {
            delete_where(get_connection(), 'milestones', 'm_id', $this->get_user_milestones()[$i]['m_id']);
        }
    }


    function validate(){
        if (isset($_POST['update_goal'])) {

            $this->empty_check('name', -1);
            $this->empty_check('description', -1);

            for($i=0; $i<$_SESSION['num_of_milestones'];$i++) {
                if ($_SESSION['delete_milestones'][$i] == 0) {
                    $this->empty_check('milestone_names', $i);
                    $this->date_check('start_dates', 'stop_dates', $i, time());
                    $this->empty_check('start_dates', $i);
                    $this->empty_check('stop_dates', $i);
                }
            }
            if(empty($this->get_errors()['name']) &&
                empty($this->get_errors()['description'])){
                $error_found=false;
                if($_SESSION['num_of_milestones']>0) {
                    for ($i = 0; $i < $_SESSION['num_of_milestones']; $i++) {
                        if ($_SESSION['delete_milestones'][$i] == 0) {
                            if (!empty($this->get_errors()['milestone_names'][$i]) ||
                                !empty($this->get_errors()['start_dates'][$i]) ||
                                !empty($this->get_errors()['stop_dates'][$i])) {
                                $error_found=true;
                            }
                        }
                    }
                }

                if($error_found==false){
                    $this->update();
                }
            }
        }
    }

    function empty_check($field, $index){
        if($index==-1){
            $index='';
        }
        if (empty($_POST[$field.$index])){
            $this->set_errors($field, $index,"Required field");
        }
    }

    function date_check($start_date, $stop_date, $index, $comp_date){
        $start_date_in_time = $_POST[$start_date.$index];
        $start_date_in_time = strtotime($start_date_in_time);

        $stop_date_in_time = $_POST[$stop_date.$index];
        $stop_date_in_time = strtotime($stop_date_in_time);

        if ($start_date_in_time < $comp_date) {
            $this->set_errors($start_date, $index,"Start date cannot pre-date current date");
        }

        if ($stop_date_in_time < $start_date_in_time) {
            $this->set_errors($stop_date, $index,"End date cannot pre-date start date");
        }

        if ($stop_date_in_time < $comp_date) {
            $this->set_errors($stop_date, $index,"End date cannot pre-date current date");
        }
    }

    function set_errors($field, $index, $error){
        if($index=='') {
            $this->errors[$field] = $error;
        } else {
            $this->errors[$field][$index] = $error;
        }
    }

    function update(){
        $this->insert_goal($this->g_id);
        $this->delete_milestones();
        insert_milestones($this->get_g_id(), $_SESSION['delete_milestones']);

        header("Location:goals.php");
        $_SESSION['num_of_milestones']=1;
    }

    function get_goal(){ return $this->goal; }
    function get_user_milestones(){ return $this->user_milestones; }
    function get_m_ids(){ return $this->m_ids; }
    function get_g_id(){ return $this->g_id; }
    function get_errors(){ return $this->errors; }
}

$edit_goal = new Edit_Goal();
milestones_init($edit_goal);
$edit_goal->delete_goal($edit_goal->get_goal());
add_to_deleted();
$edit_goal->validate();

require('../views/edit_goal.php');
?>

