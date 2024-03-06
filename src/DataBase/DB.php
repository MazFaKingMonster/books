<?php

declare(strict_types=1);

namespace DataBase;

use PDO;

class DB
{
    private PDO $PDO;
    public function __construct(string $host, string $dbname, string $user, string $pass)
    {
        $this->PDO = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    }

    public function getBooks(): array
    {
        $query = <<<QUERY
            SELECT `books`.*, `authors`.`author_name` 
            FROM `books` 
                INNER JOIN `authors` 
                    ON `books`.`author_id` = `authors`.`id`
        QUERY;
        $booksStatement = $this->PDO->query($query);

        return $booksStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addBooks(string $bookName, int $authorId, float $bookPrice): void
    {
        $query = <<<QUERY
            INSERT INTO `books` (`name`, `author_id`, `price`) 
            VALUES ('$bookName', '$authorId', '$bookPrice')
        QUERY;
        $this->PDO->query($query);
    }
    public function deleteBooks(int $bookId): void
    {
        $query = <<<QUERY
            DELETE FROM `books` 
                   WHERE `id` = '$bookId'
        QUERY;

        $this->PDO->query($query);
    }
}
