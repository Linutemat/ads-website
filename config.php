<?php

$result = [
    'database_host' => 'localhost',
    'database_port' => 3306,
    'database_name' => '',
    'database_user' => '',
    'database_password' => '',
];

$secretConfig = require './config.local.php';

return array_merge($result, $secretConfig);