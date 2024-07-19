<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_password'] = "";
$db["db_name"] = "cms";

foreach ($db as $key => $value) {
    if (!defined(strtoupper($key))) {
        define(strtoupper($key), $value);
    }
}

$con =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$con) {
    die("Connection Failed" . mysqli_connect_error());
}
