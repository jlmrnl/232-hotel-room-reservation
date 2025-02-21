<?php
session_start();
session_destroy();
header("Location: /HRR/index.php");
?>