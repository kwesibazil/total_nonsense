<?php
$dataPoints = array();
$max_score_for_kpi=[];
foreach($user_kpis as $kpi){
    $i=0;
    $total_score=0;
    $score_count=0;
    foreach ($scores as $score){
        if($kpi['k_id']==$score['k_id']){
            $total_score+=$score['score'];
            $score_count++;
        }
        $i++;
    }
    array_push($max_score_for_kpi, $score_count-$total_score);
    array_push($dataPoints, array("y" => $total_score,"label" => $kpi['title']));
    $total_score=0;
}


?>

<!DOCTYPE HTML>
<html>
<head>
    <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer",
                {
                    title:{
                        text: "KPIs"

                    },

                    axisY:{
                        interval:1,
                        maximum:7
                    },
                    data:[
                        {
                            type: "stackedBar",
                            dataPoints: [
                                <?php foreach ($dataPoints as $dataPoint){ ?>
                                {y: <?php echo htmlspecialchars($dataPoint['y'])?>, label: "<?php echo htmlspecialchars($dataPoint['label'])?>" },
                                <?php } ?>
                            ]
                        },

                        {
                            type: "stackedBar",
                            dataPoints: [
                                <?php $i=0;?>
                                <?php foreach ($dataPoints as $dataPoint){ ?>
                                {y: <?php echo htmlspecialchars($max_score_for_kpi[$i])?>, label: "<?php echo htmlspecialchars($dataPoint['label'])?>" },
                                <?php $i++;?>
                            <?php } ?>

                            ]
                        }

                    ]

                });

            chart.render();
        }
    </script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script></head>
<body>
<?php require("../templates/header.php"); ?>

<div class="chart-wrapper">
<div id="chartContainer" style="height: 300px; width: 1000px;">
</div>
</div>
</body>
</html>
