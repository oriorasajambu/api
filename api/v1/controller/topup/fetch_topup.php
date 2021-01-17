<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if($username){

    $param = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$username);

    $query =
    "SELECT *
    FROM tb_topup
    WHERE username = ?
    ORDER BY uploaded_at DESC";

    $statement = $connection->prepare($query);

    $statement->bind_param("s", $param);
    $statement->execute();

    $result = $statement->get_result();

    GetJSON($result, "data", "list");

  }
  else {
    $query =
    "SELECT *
    FROM tb_topup
    ORDER BY uploaded_at DESC";

    $result = $connection->query($query);
    GetJSON($result, "data", "list");
  }

  $connection->close();
 ?>
