<?php
class BookSessionManager
{
    public function __construct()
    {
        // Начинаем сессию при создании объекта
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function generateAddToCartButton(int $bookId): void
    {
        /**
         * TODO
         * Как работают HTML формы
         * Что такое метод POST
         * Где хранится ПХП сессия, где хранится ее ключ
         */
        echo <<<HTML
        <form action="{$_SERVER['PHP_SELF']}" method="post">
            <input type="hidden" name="book_id" value="$bookId">
            <input type="submit" value="Добавить в корзину">
        </form>
HTML;
    }
    public function addBookToSession($bookId): void
    {
        // Проверяем, установлена ли cookie с именем "user_cookie"
        if (!isset($_COOKIE['user_cookie'])) {
            // Cookie не найдена, устанавливаем новую
            setcookie('user_cookie', $this->generateUniqueCookieValue(), time() + 3600, "/"); // Срок действия 1 час
            echo "Новая cookie пользователя установлена.";
        } else {
            // Cookie уже установлена, можно добавить проверку или логику обновления
            echo "Cookie пользователя уже установлена.";
        }
        /**
         * Понять как работает этот кусок кода
         */
        // Добавляем идентификатор книги в сессию
        // Предположим, что в сессии у нас массив для хранения ID книг
        if (!isset($_SESSION['books'])) {
            $_SESSION['books'] = [];
        }
        if (!in_array($bookId, $_SESSION['books'])) {
            $_SESSION['books'][] += [ 'id'=> $bookId,
                                'name' => 'testname',
                                'qty' => 1];
            echo " Книга с testname добавлена в сессию.";
        } else {
            echo "qty $bookId увеличено на 1";
            $_SESSION['books']['qty'] += 1;
            var_dump($_SESSION['books']);
        }
    }

    private function generateUniqueCookieValue()
    {
        // Генерируем уникальное значение для cookie
        // Здесь можно использовать любой способ генерации уникального значения
        return bin2hex(random_bytes(8)); // Пример простой генерации уникального значения
    }
}