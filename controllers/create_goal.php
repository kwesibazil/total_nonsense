<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Create_Goal{
    private $m_ids;
    private $num_of_milestones;
    private $errors;

    function __construct(){
        $this->m_ids=[];
        $this->errors=['name'=>null,'description'=>'','milestone_names'=>[], 'start_dates'=>[],'stop_dates'=>[]];

        if(isset($_POST['create'])) {
            $_SESSION['delete_milestones']=[];
        }
    }

    function validate(){
        if (isset($_POST['create_goal'])) {

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
        $this->insert_goal();
        $g_id=select_last(get_connection(), 'goals', 'g_id');
        insert_milestones($g_id, $_SESSION['delete_milestones']);

        header("Location:goals.php");
        $_SESSION['num_of_milestones']=1;
    }

    function insert_goal(){
        $u_id = $_SESSION['u_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $fields='u_id, name, description';
        $values="'$u_id','$name','$description'";
        insert(get_connection(), 'goals', $fields, $values);
    }

    function get_m_ids(){
        return $this->m_ids;
    }

    function get_errors(){
        return $this->errors;
    }
}

$create_goal = new Create_Goal();
milestones_init($create_goal);
add_to_deleted();
$create_goal->validate();
require('../views/create_goal.php');

?>

