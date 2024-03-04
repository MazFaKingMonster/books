<?php

declare(strict_types=1);

class DB
{
    private PDO $PDO;
    public function __construct(string $host, string $dbname, string $user, string $pass)
    {
        $this->PDO = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    }

    public function getBooks(): array
    {
        $query = 'SELECT `books`.`id`, `name` AS `quake` FROM `books`';
        $booksStatement = $this->PDO->query($query);

        return $booksStatement->fetchAll(PDO::FETCH_ASSOC);
    }
}

$db = new DB('localhost', 'books', 'root', '');

$db->getBooks();
var_dump($db);
$books = $db->getBooks();
?>