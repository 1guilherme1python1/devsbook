<?php
session_start();
//criar url base
$base = 'https://localhost/devsbookoo';

$db_name = 'devsbook';
$db_host = 'localhost';
$db_user = 'root';

$pdo = new PDO("mysql: host=localhost; dbname=devsbook", $db_user);