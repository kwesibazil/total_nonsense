<?php
    require('../models/connect.php');
session_start();

class Login{

    function login(){
        if(isset($_POST['submit'])){
            $users= select_as_assoc(get_connection(), 'users');

            foreach($users as $user){
                if($_POST['email']==$user['email'] && 
                    password_verify($_POST['password'], $user['password'])){
                    
                    $_SESSION['current_u_id']=$user['u_id'];
                    $_SESSION['u_id']=$user['u_id'];
                    $_SESSION['email']=$_POST['email'];

                    $_SESSION['admin']=$this->admin_check();
                    $this->login_redirect();
                }
            }
        }
    }

    function admin_check(){
        $users= select_as_assoc(get_connection(), 'users');
        foreach ($users as $user){
            if(isset($_SESSION['u_id'])) {
                if ($user['u_id'] == $_SESSION['u_id'] && $user['admin'] == 1) {
                    
                    $_SESSION['a_id']=$user['u_id'];

                    return $user['email'];
                }
            }
        }
        return false;
    }

        function logout(){
            if(isset($_POST['logout'])){
                session_unset();
            }
        }

        function login_redirect(){
            if($_SESSION['admin']==false || !isset($_SESSION['admin'])){
                header('Location:goals.php');
            } else {
                header('Location:admin_panel.php');
            }
        }
    }

    $login = new Login();
    $login->login();
    $login->logout();
    require("../views/login.php");
?>

