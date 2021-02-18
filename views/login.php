<!DOCTYPE html>
<html>
<head>
    <style>
        body {
                height: 100%;

            margin:50px;
            padding: auto 0;

            text-align:center;

             display: flex;
                justify-content: center;
                align-items: center;
                            text-align:center;


        }
        label {
            float:left;
            width:100px;
        }

        input {
            display:inline-block;
            margin:10px;
            padding:10px;
            width:200px;
        }

        ul {
            margin:0px;
            padding:0px;
            list-style:none;
        }

        li {
            float:left;
            padding:10px;
        }

        nav {
            margin-bottom: 30px;
        }

        button {
            margin:0px;
            padding:0px;
        }

        #login {
            padding: 70px 0;

            width:400px;
            height:600px;
            text-align:center;
            vertical-align: middle;

            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
            border:2px solid #BBBBBB;
        }

        #submit_login {

        }

        .normal_button {
            width:220px;
            margin:10px;
            padding:10px;
            background-color:#2792cb;
            border:none;
            color:white;
        }


    </style>
</head>
<body>
    <div id="main">
        <div id="login">        
            <div id="login-content">
            <h2 id="title">Login</h2>
            <form action="login.php" method="POST">
                <input type="text" name="email"><br>

                <input type="password" name="password"><br>

                <input type="submit" name="submit" value="Login" class="normal_button">
            </form>
            </div>
        </div>
    </div>

<?php require("../templates/footer.php"); ?>
</body>
</html>