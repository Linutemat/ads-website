<?php

declare(strict_types=1);

$connection = new \PDO(
    'mysql:host=localhost:3306',
    'root',
    '', // pasikeisti passworda, jeigu pas jus kitoks
    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
);
$isOk = readline('This will delete the database. Enter \'ok\' to continue.');
if ($isOk !== 'ok') {
    die('Action cancelled');
}
$connection->exec('drop database if exists ads_website_27;');
$connection->exec('create database if not exists ads_website_27;');
$connection->exec('use ads_website_27;');

$users = "create table if not exists users (
                                     id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                     email varchar(255) not null,
    password varchar(60) not null,
    phone_number varchar(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL ON UPDATE CURRENT_TIMESTAMP()
    ); ";
$connection->exec("$users");

$ads = "create table if not exists ads (
                                   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                   user_id int not null,
                                   title varchar(255) not null,
    description text not null,
    price decimal(10, 2) not null,
    city varchar(255) not null,
    phone_number varchar(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL ON UPDATE CURRENT_TIMESTAMP()
   
    );";

$connection->exec("$ads");

$likedAds = "create table if not exists liked_ads (
                                   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                   ad_id int not null,
                                   user_id int not null,
                                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL);";

$connection->exec("$likedAds");

// galima ir taip, prideti FK po lenteles sukurimo
//$connection->exec('
//    ALTER TABLE ads ADD CONSTRAINT fk_ads_users
//        FOREIGN KEY (user_id) REFERENCES users (id)
//    ON DELETE CASCADE;
//');
echo 'Database created successfully' . PHP_EOL;
