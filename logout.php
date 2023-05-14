<?php 
require_once __DIR__.'/estructura/config.php';
setcookie('documentNumber', "", time()-3600, null,null,true,true);
setcookie('password', "", time()-3600, null,null,true,true);
session_unset();
session_destroy();
header("location: index.php");
?>