<?php

  if(isset($_GET['task'])){
    $requestPart = explode('/', $_GET['task']);
    $task = strtolower($requestPart[0]);
  }

  $path = "admin";

  switch ($task) {
    case 'update':
      require_once "$path/update_admin.php";
      break;
    default:
      require_once "$path/update_admin.php";
      break;
  }

 ?>
