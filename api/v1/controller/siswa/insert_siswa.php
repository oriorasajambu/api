<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['nama']) &&
    isset($_POST['sekolah']) &&
    isset($_POST['kelas']) &&
    isset($_POST['email'])
  ){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $sekolah = $_POST['sekolah'];
    $kelas = $_POST['kelas'];
    $email = $_POST['email'];

    $query = "INSERT INTO tb_login VALUES (?, ?, current_timestamp(), 'siswa')";
    $statement = $connection->prepare($query);
    $statement->bind_param(
      "ss",
      $username, $password
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
