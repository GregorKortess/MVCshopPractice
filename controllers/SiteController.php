<?php

class SiteController
{
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = product::getLatestProducts(6);

        // Список товаров для слайдера
        $sliderProducts = Product::getRecommendedProducts();

        require_once(ROOT . '/views/site/index.php');

        return true;
    }
    public function actionContact(){
        $userEmail = "";
        $userText = "";
        $result = false;

        if (isset($_POST['submit'])){
            $userEmail= $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            // Валидация полей
            if (!USER::checkEmail($userEmail)) {
                $errors[] = "Неправильный email";
            }
            if ($errors == false) {
                $adminEmail = "CortessHack@gmail.com";
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = "Тема письма";
                $result = mail($adminEmail,$subject,$message);
                $result = true;
            }

        }
        require_once (ROOT. '/views/site/contact.php');
        return true;
    }
}