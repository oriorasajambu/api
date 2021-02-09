<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['nama']) &&
    isset($_POST['sekolah']) &&
    isset($_POST['kelas']) &&
    isset($_POST['email']) &&
    isset($_POST['token'])
  ){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $sekolah = $_POST['sekolah'];
    $kelas = $_POST['kelas'];
    $email = $_POST['email'];
    $token = $_POST['token'];

    $query = "INSERT INTO tb_login VALUES (?, ?, current_timestamp(), 'siswa', ?)";
    $statement = $connection->prepare($query);
    $statement->bind_param(
      "sss",
      $username, $password, $token
    );

    if($statement->execute()){
      $statement->close();

      $query = "INSERT INTO tb_siswa
      VALUES (?, ?, ?, ?, ?, '0')";
      $statement = $connection->prepare($query);
      $statement->bind_param(
        "sssss",
        $username, $nama, $sekolah, $kelas, $email
      );
      $statement->execute() ?
        GetStatement($statement) :
        GetStatement($statement);

      $statement->close();
    } else GetStatement($statement);

  }
  $connection->close();

 ?>
