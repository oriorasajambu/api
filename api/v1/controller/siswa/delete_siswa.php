<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['password'])
  ){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $statement = $connection->prepare(
      "DELETE
      FROM tb_login
      WHERE username = ? AND password = ? AND role = 'siswa'"
    );
    $statement->bind_param(
      "ss",
      $username, $password
    );

    $result = array();

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();
  }

  $connection->close();
 ?>
