<?php
    $host = "feenix-mariadb.swin.edu.au";
    $user = "s101617498";
    $pwd = "071092";
    $sql_db = "s101617498_db";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);
if(!$conn) {
    echo "Connection Failed";
}