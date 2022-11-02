<?php

declare(strict_types=1);

namespace Lina\AdsWebsite\Repository;

use PDO;

class Repository
{
    protected PDO $connection;

    public function __construct()
    {
        $config = require './config.php';
        $this->connection = new PDO(
            sprintf('mysql:host=%s:%s;dbname=%s', $config['database_host'], $config['database_port'], $config['database_name']),
            $config['database_user'],
            $config['database_password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        );
    }
    public function findOneById(int $id): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM ' . $this->table . ' WHERE id = ?;');
        $statement->execute([$id]);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($results) === 0) {
            return null;
        }
        return reset($results);
    }
}
