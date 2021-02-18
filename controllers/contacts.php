<?php 
   require('../models/connect.php');
   require('../public/functions.php');

   session_start();

class Contacts {

   private $s_id=null;
   private $r_id=null;
   private $contacts=[];
   private $contact_ids=[];

   function __construct(){
      $users = select_as_assoc(get_connection(), 'users');

      if(isset($_SESSION['admin']) && $_SESSION['admin']!=false){
         $this->s_id = $_SESSION['a_id'];
         foreach($users as $user){
            if($user['admin'] == 0){

               array_push($this->contacts, $user['email']);
               array_push($this->contact_ids, $user['u_id']);
            
               for($i=0; $i<sizeof($this->contact_ids);$i++){
                  if(isset($_POST["contact$i"])){
                     $r_id=$this->contact_ids[$i];
                     break;
                  }
               }
            }
         }
      } else {
         $this->s_id = $_SESSION['u_id'];
         foreach($users as $user){
            if($user['admin'] == 1){

               array_push($this->contacts, $user['email']);
               array_push($this->contact_ids, $user['u_id']);
            
               for($i=0; $i<sizeof($this->contact_ids);$i++){
                  if(isset($_POST["contact$i"])){
                     $r_id=$this->contact_ids[$i];
                     break;
                  }
               }
            }
         }
      }
   }
   
  
   function go_to_chat(){
   
   }

   function get_contacts(){
      return $this->contacts;
   }

   function get_contact_ids(){
      return $this->contact_ids;
   }
}

$contacts = new Contacts();
require("../views/contacts.php");

?>