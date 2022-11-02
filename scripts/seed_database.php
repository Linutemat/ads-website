<?php

declare(strict_types=1);
$connection = new \PDO(
    'mysql:host=localhost:3306;dbname=ads_website_27',
    'root',
    '', // pasikeisti passworda, jeigu pas jus kitoks
    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
);
$connection->exec('use ads_website_27;');

$users = "insert into users (email, password, phone_number)
values ('abc@e.lt', '\$2y\$10\$XCoI2YhIngruM7iTJMyo5uWkzOmARRwoi2W6HzhLHQRBzEAzGnzuO', '+37012345678'),
       ('a@mail.lt', '\$2y\$10\$XCoI2YhIngruM7iTJMyo5uWkzOmARRwoi2W6HzhLHQRBzEAzGnzuO', '+37012345678'),
       ('b@mail.lt', '\$2y\$10\$XCoI2YhIngruM7iTJMyo5uWkzOmARRwoi2W6HzhLHQRBzEAzGnzuO', '+37012345678'),
       ('c@mail.lt', '\$2y\$10\$XCoI2YhIngruM7iTJMyo5uWkzOmARRwoi2W6HzhLHQRBzEAzGnzuO', '+37012345678'),
       ('d@mail.lt', '\$2y\$10\$XCoI2YhIngruM7iTJMyo5uWkzOmARRwoi2W6HzhLHQRBzEAzGnzuO', '+37012355678');";
$connection->exec($users);

$ads = "insert into ads (user_id, title, description, price, city, phone_number)
values (1, 'VW Golf', 'Great car', 12500, 'Kaunas', '+37013245678'),
       (1, 'VW Passat', 'Even better car', 17500, 'Kaunas', '+37013245678'),
       (2, 'Audi', 'Great ', 25500, 'Kaunas', '+37013245678'),
       (2, 'BMV', 'good', 20500, 'Kaunas', '+37013245678'),
       (1, 'Labai gera Masina', 'Even better car', 17500, 'Kaunas', '+37013245678'),
       (1, 'Labai gera Masina', 'Even better car', 17500, 'Kaunas', '+37013245678'),
       (2, 'bandau', 'bandau', 1, 'Kaunas', '+37013245678');
";
$connection->exec($ads);
$likedAds = "insert into liked_ads (ad_id, user_id)
values (1,1),
       (2,1),
       (3,1),
       (4,1),
       (1,2),
       (2,2),
       (3,2),
       (4,2),
       (1,3),
       (2,3),
       (3,3),
       (4,3),
       (5,3);
";
$connection->exec($likedAds);
