<?php
session_start();
session_unset();
session_destroy();

header("Location: /alquran_digital/auth/login.php");
exit;