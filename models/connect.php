<?php
class Connect{
    function __construct(){

        function select_as_assoc($conn, $table){
            $sql= "SELECT * FROM $table";
            $result= mysqli_query($conn, $sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        function select_last($conn, $table, $field){
            $sql = "SELECT $field FROM $table ORDER BY $field DESC LIMIT 1";
            $result= mysqli_query(get_connection(), $sql);
            $idRow = mysqli_fetch_assoc($result);
            return $idRow[$field];
        }

        function select_row($conn, $table, $condition, $condition_value){
            $sql= "SELECT * FROM $table WHERE $condition=$condition_value";
            $result= mysqli_query($conn, $sql);
            return mysqli_fetch_assoc($result);
        }

        function get_connection(){
            $conn = mysqli_connect("localhost", "kwesi", "password", "incrementia");
            if(!$conn){
                echo mysqli_connect_error();
            }

            return $conn;
        }

        function insert($conn, $table, $fields, $values){
            $sql= "INSERT INTO $table ($fields) VALUES ($values)";
            mysqli_query($conn, $sql);
        }

        function insert_where($conn, $table, $fields, $values, $condition, $condition_value){
            $pairs=[];
            for ($i=0; $i<sizeof($fields);$i++){
                $pair="$fields[$i]=$values[$i]";
                array_push( $pairs, $pair);
            }
            $str_pairs=implode(',', $pairs);
            $sql= "UPDATE $table SET $str_pairs WHERE $condition=$condition_value";
            mysqli_query($conn, $sql);
        }

        function delete_where($conn, $table, $condition, $condition_value){
            $sql= "DELETE FROM $table WHERE $condition=$condition_value";
            mysqli_query($conn, $sql);
        }
    }
}

$connect = new Connect();
?>

