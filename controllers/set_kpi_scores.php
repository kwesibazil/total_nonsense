<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Set_KPI_Scores{
    public $kpis=[];
    function __construct(){
        $this->kpis= select_as_assoc(get_connection(), 'kpis');
        $user_kpis=[];

        $user_categories=[];

        $user_kpis=get_user_items($this->kpis, $this->kpis, 'k_id')[0];
        require('../views/set_kpi_scores.php');
        $this->insert_scores();


    }

    function insert_scores()
    {
        $past_dates=[];
        for($i=0;$i<=7;$i++){
            $current_time= time();
            $current_date=date('Y-m-d', $current_time);
            $temp_date= date('Y-m-d',(strtotime ( "-$i day" , strtotime ($current_date) ) ));
            array_push($past_dates, $temp_date);
        }

        if (isset($_POST['submit_kpi_scores'])) {
            $i = 0;
            $scores= select_as_assoc(get_connection(), 'kpi_scores');

            foreach ($this->kpis as $kpi) {
                $score_found=false;

                $k_id = $kpi['k_id'];
                $score_post = $_POST["score$i"];
                $i++;

                $date = $_POST['today'];

                $fields = 'k_id, score, date';
                $values = "'$k_id','$score_post', '$date'";

                if($scores[0]['s_id']==null){
                    insert(get_connection(), 'kpi_scores', $fields, $values);
                } else {
                    foreach ($scores as $score) {
                        if ($kpi['k_id']==$score['k_id']) {
                            $score_found=true;
                            $past_date_found=false;
                            foreach($past_dates as $past_date) {
                                if ($score['date'] == $past_date) {
                                    $past_date_found=true;
                                }
                                if($past_date_found==false){
                                    insert(get_connection(), 'kpi_scores', $fields, $values);

                                }
                            }
                        }
                        //header("Location:kpis.php");
                    }
                    if($score_found==false){
                        insert(get_connection(), 'kpi_scores', $fields, $values);
                    }
                }
            }
        }
    }
}

function set_kpis(){

}

$set_kpi_scores = new Set_KPI_Scores();
?>




