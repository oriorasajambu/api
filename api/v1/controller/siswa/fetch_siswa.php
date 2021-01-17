<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if($username){

    $param = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$username);

    $query =
    "SELECT
      login.username,
      nama_siswa,
      sekolah,
      kelas,
      email,
      login.created,
      login.role,
      siswa.coin
    FROM `tb_login` AS login
    INNER JOIN tb_siswa AS siswa
    	ON siswa.username = login.username
    WHERE
      (login.username LIKE CONCAT('%', ?, '%') OR
      nama_siswa LIKE CONCAT('%', ?, '%') ) AND
      login.role = 'siswa'";

    if($statement = $connection->prepare($query)){
      $statement->bind_param(
        "ss",
        $param, $param
      );

      if($statement->execute()){
        $result = $statement->get_result();
        GetJSON($result, "data", "list");
      }
      else GetStatement($statement);
    }

  }
  else {

    $query =
    "SELECT
      login.username,
      nama_siswa,
      sekolah,
      kelas,
      email,
      login.created,
      login.role,
      siswa.coin
    FROM tb_login AS login
    LEFT JOIN tb_siswa AS siswa
    	ON siswa.username = login.username
    LEFT JOIN tb_guru AS guru
    	ON guru.username = login.username
    WHERE login.role = 'siswa'";

    $result = $connection->query($query);
    GetJSON($result, "data", "list");
  }

 ?>
