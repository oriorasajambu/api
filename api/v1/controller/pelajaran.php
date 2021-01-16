<?php

  if(isset($_GET['task'])){
    $requestPart = explode('/', $_GET['task']);
    $task = strtolower($requestPart[0]);
  }

  $path = "pelajaran";

  switch ($task) {
    case 'insert':
      require_once "$path/insert_pelajaran.php";
      break;
    case 'delete':
      require_once "$path/delete_pelajaran.php";
      break;
    case 'update':
      require_once "$path/update_pelajaran.php";
      break;
    default:
      require_once "$path/fetch_pelajaran.php";
      break;
  }

 ?>
