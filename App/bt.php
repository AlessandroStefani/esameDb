<?php
session_start();
require_once("utils/func.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "progdb", 3306);
?>