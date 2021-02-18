<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Create_KPI{
    private $s_ids;
    private $errors;
    private $user_kpis;

    function __construct(){
        $this->s_ids=[];
        $this->errors=['title'=>null, 'category'=>null];

        $kpis = select_as_assoc(get_connection(), 'kpis');
        $this->user_kpis=get_user_items($kpis, $kpis, 'k_id')[0];
    }

    function validate(){
        if (isset($_POST['create_kpi'])) {

            $this->empty_check('title', -1);
            $this->empty_check('category', -1);

            if(empty($this->get_errors()['title']) &&
            empty($this->get_errors()['category'])) {
                $this->update();
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

    function set_errors($field, $index, $error){
        if($index=='') {
            $this->errors[$field] = $error;
        } else {
            $this->errors[$field][$index] = $error;
        }
    }

    function update(){
        $this->insert_kpi();
        $k_id=select_last(get_connection(), 'kpis', 'k_id');

        header("Location:kpis.php");
    }

    function insert_kpi(){
        $u_id = $_SESSION['u_id'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $start_date = $_POST['start_date'];
        $expiration_date = $_POST['expiration_date'];

        $fields='u_id, title, category, start_date, expiration_date';
        $values="'$u_id','$title','$category', '$start_date', '$expiration_date'";
        insert(get_connection(), 'kpis', $fields, $values);
    }

    function new_category(){
        if(isset($_POST['create_category'])){
            return true;
        } else {
            return false;
        }
    }

    function delete_category(){
        if(isset($_POST['delete_category'])) {
            header("Location:delete_kpi_category.php");
        }
    }

    function get_s_ids(){
        return $this->s_ids;
    }

    function get_errors(){
        return $this->errors;
    }

    function get_kpis(){
        return $this->user_kpis;
    }
}

$create_kpi = new Create_KPI();
$new_category_field=false;
$new_category_field=$create_kpi->new_category();
milestones_init($create_kpi);
$create_kpi->validate();
$create_kpi->delete_category();

require('../views/create_kpi.php');

?>

