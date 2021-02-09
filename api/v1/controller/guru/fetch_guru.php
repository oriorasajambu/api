<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if($username){

    $param = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$username);

    $query =
    "SELECT
    	login.username,
      login.created,
      role,
      token,
      nama_guru,
      nama_mata_pelajaran,
      universitas,
      semester,
      bukti_pembayaran,
      guru.coin
    FROM tb_login as login
    LEFT JOIN tb_guru as guru ON login.username = guru.username
    LEFT JOIN tb_mata_pelajaran as mp ON mp.id_mata_pelajaran = guru.id_mata_pelajaran
    WHERE
      login.username = ? AND
      login.role = 'guru'";

    if($statement = $connection->prepare($query)){
      $statement->bind_param(
        "s",
        $param
      );

      if($statement->execute()){
        $result = $statement->get_result();
        GetJSON($result, "data");
      }
      else GetStatement($statement);
    }

  }
  else {
    $query =
    "SELECT
      login.username,
      login.created,
      role,
      token,
      nama_guru,
      nama_mata_pelajaran,
      universitas,
      semester,
      bukti_pembayaran,
      guru.coin
    FROM tb_login as login
    LEFT JOIN tb_guru as guru ON login.username = guru.username
    LEFT JOIN tb_mata_pelajaran as mp ON mp.id_mata_pelajaran = guru.id_mata_pelajaran
    WHERE login.role = 'guru'";

    $result = $connection->query($query);
    GetJSON($result, "data", "list");
  }

 ?>
