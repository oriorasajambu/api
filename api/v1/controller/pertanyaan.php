<?php

  if(isset($_GET['task'])){
    $requestPart = explode('/', $_GET['task']);
    $task = strtolower($requestPart[0]);
  }

  $path = "pertanyaan";

  switch ($task) {
    case 'insert':
      require_once "$path/insert_pertanyaan.php";
      break;
    case 'delete':
      require_once "$path/delete_pertanyaan.php";
      break;
    case 'update':
      require_once "$path/update_pertanyaan.php";
      break;
    default:
      require_once "$path/fetch_pertanyaan.php";
      break;
  }

 ?>
