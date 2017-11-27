<?php

//Database connection settings
$host = 'localhost';
$user = 'MYSQL-USERNAME';
$pass = 'MYSQL-PASS';
$db = 'YOUR-DB-NAME';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
