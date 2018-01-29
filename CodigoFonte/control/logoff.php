<?php
  session_start();
  $_SESSION = array();
  session_destroy();
  header('Location: ../view/index.php?logoff=true');

?>
