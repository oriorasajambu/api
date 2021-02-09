<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['new_username']) &&
    isset($_POST['new_password'])
  ){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    $query =
    "UPDATE tb_login
    SET username = ?, password = ?, created = current_timestamp()
    WHERE username = ? AND password = ? AND role = 'admin'";

    $statement = $connection->prepare($query);
    $statement->bind_param(
      "ssss",
      $new_username, $new_password, $username, $password
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();
  }

  $connection->close();

 ?>
