<?php
session_start();
session_destroy();
header("Location: loginModer.html");
exit;
?>
