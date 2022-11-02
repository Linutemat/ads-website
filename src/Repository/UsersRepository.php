<?php

declare(strict_types=1);

namespace Lina\AdsWebsite\Repository;

use PDO;

class UsersRepository extends Repository
{
    protected string $table = 'users';
    public function findAllByEmail(string $email): array
    {
        $statement = $this->connection->prepare('SELECT * FROM users WHERE email = ?;');
        $statement->execute([$email]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(array $user): void
    {
        $sql = "
          INSERT INTO users (email, password, phone_number)
          VALUES (?, ?, ?)
        ";

        $statement = $this->connection->prepare($sql);
        $statement->execute(array_values($user));
    }
}
