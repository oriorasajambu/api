<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $statement = $connection->prepare(
      "SELECT login.username, created, role, nama_siswa, siswa.coin as coin_siswa, nama_guru, guru.coin as coin_guru
      FROM `tb_login` as login
      LEFT JOIN tb_siswa as siswa ON siswa.username = login.username
      LEFT JOIN tb_guru as guru ON guru.username = login.username
      WHERE login.username = ? AND login.password = ?"
    );

    $statement->bind_param("ss", $username, $password);
    $statement->execute();

    $result = $statement->get_result();

    GetJSON($result, "data");

  }

  $connection->close();

 ?>
