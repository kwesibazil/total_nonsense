<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Manage_KPIs {
    private $user_kpis=[];

    function __construct(){
        $kpis= select_as_assoc(get_connection(), 'kpis');

        $user_categories=[];

        $this->user_kpis=get_user_items($kpis, $kpis, 'k_id')[0];
        $this->insert_scores();
        $this->delete_kpi($this->user_kpis);

        require('../views/manage_kpis.php');

    }

    function insert_scores()
    {
        $past_dates=[];
        $today=date('Y-m-d');

        if (isset($_POST['submit_kpi_scores'])) {
            $i = 0;
            $scores= select_as_assoc(get_connection(), 'kpi_scores');

            foreach ($this->get_user_kpis() as $kpi) {
                $score_found=false;

                $k_id = $kpi['k_id'];
                $score_post = $_POST["score$i"];
                $i++;

                $date = $today;

                $fields = 'k_id, score, date';
                $values = "'$k_id','$score_post', '$date'";

                if($scores[0]['s_id']==null){
                    insert(get_connection(), 'kpi_scores', $fields, $values);

                } else {
                    $insert_score=true;
                    $fields_array = ['k_id', 'score', 'date'];
                    $values_array = ["'$k_id'", "'$score_post'", "'$date'"];

                    foreach ($scores as $score) {
                        if ($kpi['k_id']==$score['k_id'] && $score['date']==$today) {
                            insert_where(get_connection(), 'kpi_scores', $fields_array, $values_array, 'k_id', $kpi['k_id']);

                            $insert_score=false;
                        }
                    }

                    if($insert_score==true){
                        insert(get_connection(), 'kpi_scores', $fields, $values);
                    }
                }
            }
                header("Location:kpis.php");
        }
    }

    function delete_kpi($user_kpis){
    $scores= select_as_assoc(get_connection(), 'kpi_scores');

    for ($i=0; $i<sizeof($user_kpis);$i++) {
        if (isset($_POST["delete_kpi$i"])) {
    }
}
        for ($i=0; $i<sizeof($user_kpis);$i++) {
            if (isset($_POST["delete_kpi$i"])) {
                delete_where(get_connection(), 'kpis', 'k_id', $user_kpis[$i]['k_id']);

                foreach ($scores as $score) {
                    if($user_kpis[$i]['k_id']== $score['k_id']){
                        delete_where(get_connection(), 'kpi_scores', 'k_id', $user_kpis[$i]['k_id']);

                    }
                }

                $_POST=array();
                header("Location:redirect.php");
            }
        }
    }

    function get_user_kpis(){
        return $this->user_kpis;
    }

    function check_if_checked($selected_score, $selected_kpi){
        $scores= select_as_assoc(get_connection(), 'kpi_scores');

        $i=0;
        foreach($this->user_kpis as $kpi){
            foreach($scores as $score){
            if($kpi['k_id']== $score['k_id'] && 
                $kpi['k_id']== $selected_kpi &&
                $score['score']==$selected_score && 
                $score['date']==date("Y-m-d")){

                return "checked";

            }
        }
        $i++;
    }

    }
}

$manage_kpis = new Manage_KPIs();

?>




