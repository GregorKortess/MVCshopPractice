<?php

class AdminController extends AdminBase
{
    // Стартовая страница админ панели
    public function actionIndex()
    {
        // Проверка допступа
    self::checkAdmin();

    // Подключаем вид
        require_once(ROOT. '/views/admin/index.php');
        return true;
    }
}