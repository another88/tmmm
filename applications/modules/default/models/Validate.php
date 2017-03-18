<?php
 
class Validate 
{
	// Имя невалидного ключа
	protected static $errorKey = '';

	// Валидация имени пользователя
	public static function username($data)
	{
            //Кирилица, латиница, цифры, "_", ".", "-","$". Имя пользователя не может одновременно состоять из кирилицы и латиницы.
            //return (bool)preg_match('/^(?: (?: [a-z0-9\_\-\$]{3,32} ) | (?: [а-я0-9\_\-\$]{3,32} ) )$/ix', $data);

            // Латиница, цифры, "_", "-". /^[a-z0-9\\_\\-]{3,32}$/i
            return (bool)preg_match('/^[a-z0-9\_\-]{3,32}$/i', $data);
	}

	// Валидация e-mail
	public static function email($data)
	{
            return (bool)filter_var($data, FILTER_VALIDATE_EMAIL);  
	}

	// Валидация username и email
	public static function login($data)
	{
            if (Validate::email($data) || Validate::username($data)) return true;

            return false;
	}

	public static function md5($data)
	{
            // (bool)preg_match('/^[\\da-f]{32}$/', $data)
            return (bool)preg_match('/^[\da-f]{32}$/', $data);
	}

	// Валидация пароля
	public static function password($data)
	{
            foreach(func_get_args() as $value)
                {
                    if (preg_match('/^.{6,32}$/', $value)) continue;
                    return false;
                }
            return true;
	}

	// Валидация ID пользователя
	public static function userId($data)
	{
            // @ref Validate::id()
            return self::id($data);
	}

	// Валидация числового ID. !!! 0 - НЕ ВАЛИДНЫЙ ID !!!
	/**
	 * @param $data1..$dataN числовой ID
	 * @return bool
	 */
	public static function id($data1, $dataN = null)
	{
            foreach(func_get_args() as $value)
                    {
                    if (self::unsignedInt($value) && $value > 0) continue;
                    return false;
                    }
            return true;
	}

	// Валидация целого числа
	public static function int($data)
	{
            foreach(func_get_args() as $value)
                    {
                    if (is_bool($value)) return false;
                    if (preg_match('/^\-?\d+$/', $value)) continue;
                    return false;
                    }
            return true;
	}

	public static function unsignedInt($data)
	{
            foreach(func_get_args() as $value)
                    {
                    if (self::int($value) && $value >= 0) continue;
                    return false;
                    }
            return true;
	}

	// Валидация float
	public static function float($data)
	{
            // (bool)preg_match('/^\\d+$/',$data)

            return (bool)preg_match('/^[+\-]?\d+(?:\.\d{1,64})?$/', $data);

            //return (bool)preg_match('/^\d+$/',$data);
	}

	// Валидация беззнакового float
	public static function unsignedFloat($data)
	{
            // return (self::float($data) && $data >=0)
            return (self::float($data) && $data >=0);
	}

	// Валидация логических данных. True возвращают следующие значения $data: true, false, 1, 0, "1", "0"
	public static function logic($data)
	{
            foreach(func_get_args() as $value)
                    {
                    if (is_bool($value)) continue;
                    if (Validate::int($value) && ((int)$value == 1 || (int)$value == 0)) continue;
                    return false;
                    }
            return true;
	}


	// Валидация массива данных
	/**
	 * @param array $data Ассоциативный массив данных
	 * @return bool true - если все данные валидны, иначе - false
	 */
	public static function all($data)
	{
            self::$errorKey = '';
            if (!is_array($data) || empty($data)) return false;

            foreach ($data as $key => $value)
                    {
                    if (!self::$key($value))
                            {
                            self::$errorKey = $key;
                            return false;
                            }
                    }
            return true;
	}

	// Получить невалидный ключ при обработке @ref Validate::all()
	/**
	 * @return string|bool невалидный ключ, если он есть (один из ключей невалидный), иначе - false
	 */
	public static function getErrorKey()
	{
            return self::$errorKey;
	}

	// Валидация даты
	public static function date($data)
	{
            foreach(func_get_args() as $value)
                    {
                    if (preg_match('/^(0?[1-9]|[1-2][0-9]|3[01])\.(0?[1-9]|1[0-2])\.(19|20)\d{2}$/', $value)) continue;
                    return false;
                    }
            return true;
	}

	// Валидация даты и времени
	public static function dateTime($data)
	{
            foreach(func_get_args() as $value)
                    {
                    if (preg_match('/^(0?[1-9]|[1-2][0-9]|3[01])\.(0?[1-9]|1[0-2])\.(19|20)\d{2} (0?[0-9]|1[0-9]|2[0-3]):(0?[0-9]|[1-5][0-9])$/', $value)) continue;
                    return false;
                    }
            return true;
	}
        
	// Валидация номера телефона
	public static function phone($data)
	{
            return (bool)preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/',$data);
	}       
        
	// Валидация номера телефона
	public static function string($data)
	{
            if( trim($data) == '' )
            {
                return false;
            }
            else if( empty($data) )
            {
                return false;
            }
            else
            {
                return true;
            }
	}               
}

?>
