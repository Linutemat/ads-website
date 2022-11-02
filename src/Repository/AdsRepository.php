<?php

declare(strict_types=1);

namespace Lina\AdsWebsite\Repository;

use PDO;

class AdsRepository extends Repository
{
    protected string $table = 'ads';
    public function findAll(): array
    {
        $statement = $this->connection->prepare('SELECT * FROM ads;');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllByUserId(int $userId): array
    {
        $statement = $this->connection->prepare('SELECT * FROM ads WHERE user_id = ?;');
        $statement->execute([$userId]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findLikedAdsByUserId(int $userId): array
    {
        $statement = $this->connection->prepare('SELECT l.ad_id, title, description, price, city, phone_number, a.created_at, a.updated_at
FROM liked_ads l
JOIN ads a on l.ad_id = a.id WHERE l.user_id = ?;');
        $statement->execute([$userId]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(array $ad): void
    {
        $sql = "
          INSERT INTO ads (user_id, title, description, price, city, phone_number)
          VALUES (?, ?, ?, ?, ?, ?)
        ";

        $statement = $this->connection->prepare($sql);
        $statement->execute(array_values($ad));
    }
    public function createNewLikedAd(int $ad_id): void
    {
        $sql = "
          INSERT INTO liked_ads (ad_id, user_id)
          VALUES (?, ?)
        ";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$ad_id, $_SESSION['user_id']]);
    }

    public function findOneLikedAdById(int $id): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM liked_ads WHERE ad_id = ? AND user_id=?;');
        $statement->execute([$id, $_SESSION['user_id']]);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($results) === 0) {
            return null;
        }
        return reset($results);
    }

    public function update($data): void
    {
        $statement = $this->connection->prepare(
            'UPDATE ads SET title = ?, description = ?, price = ?, phone_number = ?, city = ? WHERE id = ?;'
        );
        $statement->execute(array_values($data));
    }
    public function unlike($id): void
    {
        $statement = $this->connection->prepare(
            'DELETE FROM liked_ads  WHERE id=?;'
        );
        $statement->execute([$id]);
    }
    public function delete($id): void
    {
        $statement = $this->connection->prepare(
            'DELETE FROM ads  WHERE id = ?;'
        );
        $statement->execute([$id]);
    }
}
