<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['coin'])
  ){

    $username = $_POST['username'];
    $coin = $_POST['coin'];

    $query = "UPDATE tb_guru SET coin = coin - ? WHERE username = ?";

    $statement = $connection->prepare($query);
    $statement->bind_param(
      "is",
      $coin, $username
    );
    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);
    $statement->close();
  }

 ?>
