<?php
$muser = $argv[1];
$mpwd = $argv[2];
$db=new mysqli("localhost",'root','root','mysql');

if(mysqli_connect_errno()){
  echo mysqli_connect_error();
}
$sql ="CREATE USER '{$muser}'@'localhost' IDENTIFIED BY  '{$mpwd}';";
$rs = $db->query($sql);

$sql ="GRANT USAGE ON *.* TO '{$muser}'@'localhost' IDENTIFIED BY '{$mpwd}' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;";
$rs = $db->query($sql);

$sql ="CREATE DATABASE IF NOT EXISTS  `{$muser}` ;";
$rs = $db->query($sql);

$sql ="GRANT ALL PRIVILEGES ON  `{$muser}` . * TO  '{$muser}'@'localhost';";
$rs = $db->query($sql);
