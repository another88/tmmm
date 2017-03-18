<?php

/**
 * Generator
 * 
 * Class used for generation of unique strings (passwords, etc.)
 * 
 * @author a.poteryahin@gmail.com
 * updated: 12/17/08
 */
class Generator
{
	  
	/**
	 * generates random string with specified length
	 * @return 
	 * @param $length length of randomly generated string
	 * @param $str list of characters used in generation
	 */
	public static function uniqueKey($length = 16, $str = null)
	{
            $res = '';
            if (is_null($str)) {
                    $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            }
            for ($i = 0; $i < $length; $i++) {
                    $res .= substr(str_shuffle($str), 0, 1);
            }
            return $res;
	}
	
	public static function generateName($name, $length=10)
        {
            if (strlen(trim($name))!=0) {
                    $src = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
                $src .= '0123456789';
                    $str = "";
                    for ($i=0; $i<$length; $i++) {
                        $char = substr($src, mt_rand(0,strlen($src)-1), 1);
                        $str .= $char;
                    }
                $tmp = explode(".",$name);
                return $str.".".$tmp[count($tmp)-1];
            }
            else {
                    return '';
            }
	}
}
