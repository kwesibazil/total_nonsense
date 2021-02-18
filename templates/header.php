<?php
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            text-align:center;
        }

      

        textarea {
            width:205px;
            height:50px;

            resize:none;

            margin:10px;
            padding:10px;

        }

        a {
            color:white;
            text-decoration: none;  

        }



        a:hover {
            background-color:#DD7020;
        }

         select {
            display:inline-block;
            margin:10px;
            padding:10px;
            width:200px;
            margin:2px;

        }

        
        label {
            float:left;
            width:110px;
        }


        ul {
            margin:0px;
            padding:0px;
            list-style:none;
        }

        li {
            float:left;
        }

        nav {
        
           width:100%;
            border:1px solid #BBBBBB;
            height:70px;
            background-color:#FF914D;
            color:white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align:right;
            
        }

        .content {
           float:right;

        }

        a {
            color:white;
            width:100%;
            padding:20px;

            height:100%;

        }

        .lo-li {
            padding-left:30px;
        }

         #logout {
            border:none;
            background-color:white;
            color:#FF914D;
            all: unset;
        }

        #logout:hover {
            background-color:#DD7020;
          color: white;
        }


        footer {
            margin-top:130px;
            height:300px;
            background-color:#FF914D;

        }

        .time {
            font-size:14px;
            color:#b6b6b6;
        }

        .goals-container {
            display:block;
            width:100%;


             display: flex;
                justify-content: center;
                align-items: center;
                            text-align:center;

                            width:100%;
            display:block; 
            display: flex;
            justify-content: center;
            align-items: center;
            text-align:center;

        }

        .title {
            font-weight:bold;
        }

        .goals-wrapper {
            width:1000px;


        }

        .um-container {
            display:block;
            width:100%;


             display: flex;
                justify-content: center;
                align-items: center;
                            text-align:center;

                            width:100%;
            display:block; 
            display: flex;
            justify-content: center;
            align-items: center;
            text-align:center;

        }



        .um-wrapper {
            width:1000px;


        }

      

        /* .card {
            width:30%;
            height:180px;

            border:1px solid #e6e6e6;
            background-color:#f6f6f6;
            padding:50px;
            margin:20px;
            display:inline-block;

        } */

         .kpi-cards {
            width:30%;
            /* height:180px; */

            border:1px solid #e6e6e6;
            background-color:#f6f6f6;
            padding:50px;
            margin:20px;
            display:inline-block;
            text-align: center;
        }

        .rb {
            width:15px;
        }

         .eg-container {
            display:block;
            width:100%;


             display: flex;
                justify-content: center;
                align-items: center;
                            text-align:center;

                            width:100%;
            display:block; 
            display: flex;
            justify-content: center;
            align-items: center;
            text-align:center;

        }

         .mk-container {
            display:block;
            width:100%;


             display: flex;
 

                            width:100%;
            display:block; 
            display: flex;
            justify-content: center;
            align-items: center;
            text-align:center;

        }

        .mk-wrapper {
            width:1000px;


        }

        .eg-wrapper {
            width:1000px;


        }

            .egF-card {
            width:20%;
            height:360px;

            border:1px solid #e6e6e6;
            background-color:#f6f6f6;
            padding:50px;
            margin:20px;
            display:inline-block;
        }


        /* .vg-card {
            width:20%;
            height:360px;

            border:1px solid #e6e6e6;
            background-color:#f6f6f6;
            padding:50px;
            margin:20px;
            display:inline-block;
        } */

         .um-card {
            width:30%;
            height:75px;

            border:1px solid #eeebaa;
            background-color:#fffcbb;
            padding:50px;
            margin:20px;
            display:inline-block;



        }

        input[type=submit] {
            margin:5px;
            padding:5px;
        }

          input[type=submit] {
            margin:5px;
            padding:5px;
        }

        .delete {
           

            width:150px;
            height:30px;
            margin:10px;
            padding:10px;
            background-color:#B53737;
            border:none;
            color:white;
        }

        .cancel {
            background-color:#DDDDDD;
            border:none;
        }

        .normal_button {
            width:200px;
            height:40px;
            margin:10px;
            padding:10px;
            background-color:#FF914D;
            border:none;
            color:white;
        }

        .sub_button {
            width:150px;
            height:30px;

            background-color:#73be73;
            border:none;
            color:white;
        }

        .chat {
            width:90%;
            text-align:center;
            height:100px;
        }

        .errors {
            color:red;
            display:inline;
        }

        .bubble-left {
            margin-left:30px;
            text-align:left;
        }

        .bubble-right {
            margin-left:200px;
            text-align:left;
        }

        .contact {
            width:20%;
            height:100px;
            background-color:#73be73;
            color:white;
            border-style:none;
        }

        .contact-div {
            margin-left:50px;
            text-align:center;
        }

        .chart-wrapper {
                        padding-top:100px;

                display: flex;
            justify-content: center;
            align-items: center;
            text-align:center;
        }

        .bubble-right {
            width:50%;
            float:right;
            text-align:right;
            padding:10px 100px;
            background-color:#dcf8c6;
            margin:10px;
        }

        .bubble-left {
            width:50%;
            float:left;
            text-align:left;
            padding:10px 100px;
            background-color:#f6f6f6;
            margin:10px;
        }

    </style>

<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/styles.css">
    <title>Home</title>


</head>

<nav>
        <div class="container">
        <div class="content">
        <ul class="items ">
            <?php if(($_SESSION['admin']!=false && 
                $_SESSION['email'] != $_SESSION['admin']) ||
                $_SESSION['admin']==false) { ?>
            
            <li class="nav-"><a class="text-white text-decoration-none"href="goals.php">Goal Tracker</a></li>
            <li><a class="text-white text-decoration-none"href="kpis.php">KPI Tracker</a></li>
            
            <?php } ?>

            <li><a class="text-white text-decoration-none"href="contacts.php">Messages</a></li>

            <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] != false){ ?>
                <li><a class="text-white text-decoration-none"  href="admin_panel.php">Admin Panel</a></li>
            <?php } ?>
            
            <li>
                <?php
                if(isset($_SESSION['email']) && isset($_SESSION['admin'])) {
                    if($_SESSION['admin']!=false){
                        echo $_SESSION['admin'];
                    } else {
                        echo $_SESSION['email'];
                    }
                }
                ?>    
                </li>
            <li class="lo-li">
                <form action="../controllers/login.php" method="POST">
                    <input type="submit" name="logout" value="logout" id="logout">
                </form>
            </li>
        </ul>
    </div>
</div>
    </nav>
    <br>
    <br>

<body>

