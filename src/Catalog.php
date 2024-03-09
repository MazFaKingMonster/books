<?php
use DataBase\DB;

/**
 * @var DB $db
 */
class Catalog
{
    public function __construct($db, $session_manager)
    {
        ?>
        <table>
            <caption>Каталог Книг</caption>
            <thead>
            <tr>
                <th>Название</th>
                <th>Автор</th>
                <th>Цена</th>
                <th>Добавить</th>
            </tr>
            </thead>
            <?php $this->fillCatalog($db, $session_manager);?>
        </table>
        <?php
    }
    public function fillCatalog($db, $session_manager): void
    {
    foreach ($db->getBooks() as $item):
        ?>
        <tr>
            <td><?=$item['name']?></td>
            <td><?=$item['author_name']?></td>
            <td><?=$item['price']?></td>
            <td><?php $session_manager->generateAddToCartButton($item['id']); ?>
            </td>
        </tr>
    <?php
    endforeach;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'])) {
            $session_manager->addBookToSession($_POST['book_id']);
        }
    }
}
?>