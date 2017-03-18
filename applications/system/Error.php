<?php

/**
 * Error
 * 
 * Ручной обработчик ошибок
 * 
 */
class Error 
{

    /**
     * Управление ошибками
     *
     * @param exception $exception Перехватываемое исключение
     */
    public static function catchException(Exception $exception) 
    {

        // Получение текста ошибки
        $message = $exception->getMessage();
        // Получение трейса ошибки как строки
        $trace = $exception->getTraceAsString();
        $str = 'ERROR: ' . $message . "\n" . $trace;

        $cnf = Zend_Registry::get('cnf');

        // Если включен режим отладки отображаем сообщение о ошибке на экран
        if($cnf->debug->on) {
            Zend_Debug::dump($str);
        } 
        // Иначе выводим сообщение об ошибке 
        else {
            // Здесь может происходить логирование ошибки, уведомление вебмастера и т д
            die('System error! Please try later');
        }
    }
}