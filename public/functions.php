<?php
function get_user_items($items1, $items2, $id, $u_id="u_id"){
    $filtered_items=[];
    $filtered_sub_items=[];

    foreach($items1 as $item1) {
        if ($item1['u_id'] == $_SESSION[$u_id]) {
            array_push($filtered_items, $item1);
        }

        foreach($items2 as $item2){
            if($item2[$id] == $item1[$id]){
                array_push($filtered_sub_items, $item2);
            }
        }
    }
    return [$filtered_items, $filtered_sub_items];
}

function milestones_init($obj){
    if(isset($_POST['num_of_milestones_init'])){
        $_SESSION['num_of_milestones']=0;
        $_SESSION['num_of_milestones']+=sizeof($obj->get_m_ids());
    } else if(isset($_POST['add_milestone'])) {
        $_SESSION['num_of_milestones']+=1;
        array_push($_SESSION['delete_milestones'], 0);
    }
}

function insert_milestones($g_id, $deleted){

        for($i=0; $i<$_SESSION['num_of_milestones'];$i++){
        $milestone_names= $_POST['milestone_names'.$i];
        $start_dates= $_POST['start_dates'.$i];
        $stop_dates= $_POST['stop_dates'.$i];

        if($deleted[$i]==0) {
            $fields = 'g_id, name, start_date, end_date';
            $values = "'$g_id','$milestone_names','$start_dates','$stop_dates'";
            insert(get_connection(), 'milestones', $fields, $values);
        }
    }
}

function add_to_deleted(){
    for($i=0;$i<$_SESSION['num_of_milestones'];$i++) {
        if (isset($_POST['delete_milestone'.$i])) {
            $_SESSION['delete_milestones'][$i]=1;
        }
    }
}

define('CHARSET', 'ISO-8859-1');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

function html($string) {
    return htmlspecialchars($string, REPLACE_FLAGS, CHARSET);
}

?>