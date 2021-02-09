<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['title']) &&
    isset($_POST['message']) &&
    isset($_POST['username'])
  ){
    $title = $_POST['title'];
    $message = $_POST['message'];
    $username = $_POST['username'];

    $query = "SELECT token FROM `tb_login` WHERE username = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param(
      "s",
      $username
    );

    if($statement->execute()){
      $result = $statement->get_result();
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        SendNotification($title, $message, $row['token']);
      }
    }
  }
  else if(
    isset($_POST['title']) &&
    isset($_POST['message']) &&
    isset($_POST['topic'])
  ){
    $title = $_POST['title'];
    $message = $_POST['message'];
    $topic = $_POST['topic'];

    SendNotification($title, $message, $topic);
  }



 ?>
