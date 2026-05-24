<?php

session_start();

// clear session
session_unset();

session_destroy();


// go home
header("Location: index.php");
exit();
