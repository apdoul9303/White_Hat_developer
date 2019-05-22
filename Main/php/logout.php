<?php
session_start();

session_destroy();

//go bake to the index
header("Location: ../index.php");

?>
