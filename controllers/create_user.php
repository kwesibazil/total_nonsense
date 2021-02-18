<?php
require('../models/connect.php');
require('../public/functions.php');

session_start();

class Create_User{
    private $u_ids;
    private $errors;
    private $users;

    function __construct(){
        $this->u_ids=[];
        $this->errors=['email'=>null, 'password'=>null, 'confirm_password'=>null, 'admin_priv'=>null];
        $this->users = select_as_assoc(get_connection(), 'users');
    }

    function validate(){
        if (isset($_POST['create_user'])) {

            $this->empty_check('email', -1);
            $this->empty_check('password', -1);
            $this->empty_check('confirm_password', -1);
            $this->empty_check('admin_priv', -1);

            $this->matching_passwords_check('password', 'confirm_password');

            if(empty($this->get_errors()['email']) &&
            empty($this->get_errors()['password']) &&
            empty($this->get_errors()['confirm_password']) &&
            empty($this->get_errors()['admin_priv'])) {
                $this->insert_user();
            }
        }
    }

    function empty_check($field, $index){
        if($index==-1){
            $index='';
        }
        if (empty($_POST[$field.$index])){
            $this->set_errors($field, $index,"Field cannot be empty");
        }
    }

    function matching_passwords_check($password, $confirm_password){
        if($password==$confirm_password){
            $this->set_errors('password', '',"Passwords do not match");
            $this->set_errors('confirm_password', '',"Passwords do not match");
        }
    }

    function set_errors($field, $index, $error){
        if($index=='') {
            $this->errors[$field] = $error;
        } else {
            $this->errors[$field][$index] = $error;
        }
    }

    function insert_user(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password=password_hash ($password, PASSWORD_DEFAULT);
        $admin = $_POST['admin_priv'];
        if($_POST['admin_priv']==2){
            $admin=0;
        }

        $fields='email, password, admin';
        $values="'$email','$password', '$admin'";
        insert(get_connection(), 'users', $fields, $values);
        header("Location:admin_panel.php");
    }

    function get_u_ids(){
        return $this->u_ids;
    }

    function get_errors(){
        return $this->errors;
    }

    function get_users(){
        return $this->users;
    }
}

$create_user = new Create_User();
$create_user->validate();

require('../views/create_user.php');

?>

