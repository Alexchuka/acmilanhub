<?php

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';

$mysql_db = 'lr';

if (@!mysql_connect($mysql_host, $mysql_user, $mysql_pass) or @!mysql_select_db($mysql_db)){
     die(mysql_error());
}
	





?>