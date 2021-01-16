<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['new_username']) &&
    isset($_POST['password']) &&
    isset($_POST['new_password']) &&
    isset($_POST['nama']) &&
    isset($_POST['sekolah']) &&
    isset($_POST['kelas']) &&
    isset($_POST['email'])
  ){

    $username = $_POST['username'];
    $new_username = $_POST['new_username'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $nama = $_POST['nama'];
    $sekolah = $_POST['sekolah'];
    $kelas = $_POST['kelas'];
    $email = $_POST['email'];

    $statement = $connection->prepare(
      "UPDATE tb_login
      SET username = ?, password = ?
      WHERE username = ? AND password = ? AND role = 'siswa'"
    );
    $statement->bind_param(
      "ssss",
      $new_username, $new_password, $username, $password
    );

    if($statement->execute()){
      $statement->close();
      $statement = $connection->prepare(
        "UPDATE tb_siswa
        SET
          nama_siswa = ?,
          sekolah = ?,
          kelas = ?,
          email = ?
        WHERE username = ?"
      );
      $statement->bind_param(
        "sssss",
        $nama, $sekolah, $kelas, $email, $new_username
      );

      $statement->execute() ?
        GetStatement($statement) :
        GetStatement($statement);

      $statement->close();
    }
    else $result = GetStatement($statement);

  }

  $connection->close();
 ?>
