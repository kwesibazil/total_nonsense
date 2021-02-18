<?php
    require('../models/connect.php');
    require('../public/functions.php');

    session_start();

    class KPIs{
        function __construct(){
            $time_today = time();
            $date_today=date('Y-m-d', $time_today);

            $kpis=[];
            $kpis_temp = select_as_assoc(get_connection(), 'kpis');
            foreach ($kpis_temp as $kpi_temp){
                if($date_today < $kpi_temp['expiration_date']){
                   array_push($kpis, $kpi_temp);
                }
            }

            $user_kpis=get_user_items($kpis, $kpis, 'k_id')[0];
            $scores= select_as_assoc(get_connection(), 'kpi_scores');
            require('../views/chart.php');

            require('../views/kpis.php');
        }
    }

    $kpis = new KPIs();
?>




