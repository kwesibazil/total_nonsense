<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Edit_KPI {
    private $k_id;
    private $kpi;

    function __contruct(){
        $kpis = select_as_assoc(get_connection(), 'kpis');
        $user_kpis=get_user_items($kpis, $kpis, 'k_id')[0];

        $i=0;
        foreach ($user_kpis as $kpi){
            if(isset($_POST["edit_kpi$i"])){
                $this->k_id=$kpi['k_id'];
                $this->kpi=$kpi[$this->k_id];

            }
            $i++;
        }
    }

    function get_k_id(){
        return $this->k_id;
    }

    function get_kpi(){
        return $this->kpi;
    }
}
    $edit_kpi = new Edit_KPI();
    require('../views/edit_kpi.php');

?>