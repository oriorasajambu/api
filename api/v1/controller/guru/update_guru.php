<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['new_username']) &&
    isset($_POST['password']) &&
    isset($_POST['new_password']) &&
    isset($_POST['nama']) &&
    isset($_POST['universitas']) &&
    isset($_POST['semester']) &&
    isset($_POST['id_mata_pelajaran'])
  ){

    $username = $_POST['username'];
    $new_username = $_POST['new_username'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $nama = $_POST['nama'];
    $universitas = $_POST['universitas'];
    $semester = $_POST['semester'];
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];

    $statement = $connection->prepare(
      "UPDATE tb_login
      SET username = ?, password = ?
      WHERE username = ? AND password = ? AND role = 'guru'"
    );
    $statement->bind_param(
      "ssss",
      $new_username, $new_password, $username, $password
    );

    if($statement->execute()){
      $statement->close();
      $statement = $connection->prepare(
        "UPDATE tb_guru
        SET nama_guru = ?,
        universitas = ?,
        semester = ?,
        id_mata_pelajaran = ?
        WHERE username = ?"
      );
      $statement->bind_param(
        "sssis",
        $nama, $universitas, $semester, $id_mata_pelajaran, $new_username
      );

      $statement->execute() ?
        GetStatement($statement) :
        GetStatement($statement);

      $statement->close();
    }
    else GetStatement($statement);
  }

  $connection->close();
 ?>
