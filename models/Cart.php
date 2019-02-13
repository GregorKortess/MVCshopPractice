<?php
class Cart
{
    public static function addProduct($id)
    {
        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если в корзине уже есть товары (В сессии )
        if (isset($_SESSION['products'])) {
            // То заполняем наш массив товарами
            $productsInCart = $_SESSION['products'];
        }
        // Если товар в корзине , но был добавлен ещё раз , увеличим его количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++ ;
        } else {
            // Добавляем новый товар в корзину
            $productsInCart[$id] = 1;
        }
        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    // Удаление товара из корзины
    public static function  deleteProduct($id)
    {
        // Получаем массив с индификатором и количество товаров
        $productsInCart = self::getProducts();
        // Удаляем из массива элемент с указанным ID
        unset($productsInCart[$id]);
        // Записываем массив товаров с удаленным элементом в сессию
        $_SESSION['products'] = $productsInCart;
    }
    // Подсчёт количества товара в коризне(сессии)
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0 ;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0 ;
        }
    }
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        $total = 0;

        if ($productsInCart) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
}