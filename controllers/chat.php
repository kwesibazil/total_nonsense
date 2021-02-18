<?php 
   require('../models/connect.php');
   require('../public/functions.php');

   session_start();

class Chat {
   private $s_id=null;
   private $r_id=null;
   private $sender=null;
   private $receiver=null;
   private $messages=[];
   private $users=[];

   function __construct(){
      $this->users = select_as_assoc(get_connection(), 'users');

      $this->set_s_id();
      $this->set_r_id($this->users);
   }

   function set_s_id(){
      if(isset($_SESSION['a_id']) && $_SESSION['a_id']!=false){
         $this->s_id = $_SESSION['a_id'];
      } else {
         $this->s_id = $_SESSION['u_id'];
      }
   }

   function set_r_id($users){
      foreach($users as $user){
         $temp_r_id=$user['u_id'];
         if(isset($_POST[$temp_r_id])){
            $this->r_id = $temp_r_id;
            $this->receiver=$_POST[$temp_r_id];
            break;
         }
      }
      if(isset($_POST['r_id'])){
         $this->r_id=$_POST['r_id'];
      }
   }  

   function get_s_id(){
      return $this->s_id;
   }

   function get_r_id(){
      return $this->r_id;
   }

   function insert_message(){
      if(isset($_POST['send_message'])){

        $s_id = $this->get_s_id();
        $r_id = $this->get_r_id();
        $message = $_POST['message'];
        $time = date("H:i");
        $today = date("Y-m-d");

        $fields='s_id, r_id, message, time, date';
        $values="'$s_id','$r_id','$message', '$time', '$today'";
        insert(get_connection(), 'messages', $fields, $values);

      }  
   }

   function set_messages(){
      $messages = select_as_assoc(get_connection(), 'messages');
      foreach($messages as $message){
         if($message['s_id']==$this->get_s_id() && $message['r_id']==$this->get_r_id() ||
            $message['s_id']==$this->get_r_id() && $message['r_id']==$this->get_s_id()){
            array_push($this->messages, $message);
         }
      }
   }

   function get_messages(){
      return $this->messages;
   }

   function get_users(){
      return $this->users;
   }

   function get_sender($s_id){
      foreach($this->get_users() as $user){
         if($user['u_id']==$s_id){
            return $user['email'];
         }
      }
   }

   function get_receiver(){
     return $this->receiver;
   }
}

$chat = new Chat();
$chat->insert_message();
$chat->set_messages();
require("../views/chat.php");

?>