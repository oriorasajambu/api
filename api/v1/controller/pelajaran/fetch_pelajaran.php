<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  $query =
  "SELECT * FROM `tb_mata_pelajaran`";
  $result = $connection->query($query);
  GetJSON($result, "pelajaran", "list");

 ?>
