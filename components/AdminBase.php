<?php
// Класс необходимой для логики контроллеров админки
abstract class AdminBase
{
    public static function checkAdmin()
    {
        // Пользователь авторизирован ?
        $userId = User::checkLogged();
        // Получаем информацию о пользователе
        $user = User::getUserById($userId);
        // Если админ то пускаем в скрытый раздел
        if($user['role'] == 'admin') {
            return true;
    }
        // Иначе завершаем работу и показываем сообщение о закрытом доступе
        die("Access denied");
    }
}