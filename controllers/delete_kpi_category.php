<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Delete_KPI_Category {
    function __construct(){


        $kpis = select_as_assoc(get_connection(), 'kpis');

        $user_kpis=get_user_items($kpis, $kpis, 'k_id')[0];

        $this->delete_category($user_kpis);
        $this->return_to_create_kpi();

        $kpis = select_as_assoc(get_connection(), 'kpis');
        $user_kpis=get_user_items($kpis, $kpis, 'k_id')[0];

        require('../views/delete_kpi_category.php');



    }

    function delete_category($user_kpis){
        for($i=0; $i<sizeof($user_kpis);$i++){
            $user_kpi_category=$user_kpis[$i]['category'];
            if(isset($_POST["delete_kpi_category$user_kpi_category"])){
                insert_where(get_connection(), 'kpis', ['category_deleted'], ['1'], 'k_id', $user_kpis[$i]['k_id']);

            }
        }

    }

    function return_to_create_kpi(){
        if(isset($_POST['return'])){
            header("Location:../controllers/create_kpi.php");
        }
    }
}

$delete_kpi_category = new Delete_KPI_Category();
?>




