<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Debug
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Concrete class for generating debug dumps related to the output source.
 *
 * @category   Zend
 * @package    Zend_Debug
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

class Zend_Debug
{

    /**
     * @var string
     */
    protected static $_sapi = null;

    /**
     * Get the current value of the debug output environment.
     * This defaults to the value of PHP_SAPI.
     *
     * @return string;
     */
    public static function getSapi()
    {
        if (self::$_sapi === null) {
            self::$_sapi = PHP_SAPI;
        }
        return self::$_sapi;
    }

    /**
     * Set the debug ouput environment.
     * Setting a value of null causes Zend_Debug to use PHP_SAPI.
     *
     * @param string $sapi
     * @return void;
     */
    public static function setSapi($sapi)
    {
        self::$_sapi = $sapi;
    }

    /**
     * Debug helper function.  This is a wrapper for var_dump() that adds
     * the <pre /> tags, cleans up newlines and indents, and runs
     * htmlentities() before output.
     *
     * @param  mixed  $var   The variable to dump.
     * @param  string $label OPTIONAL Label to prepend to output.
     * @param  bool   $echo  OPTIONAL Echo output if true.
     * @return string
     */
    public static function dump($var, $label=null, $echo=true)
    {
        // format the label
        $label = ($label===null) ? '' : rtrim($label) . ' ';

        // var_dump the variable into a buffer and keep the output
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // neaten the newlines and indents
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        if (self::getSapi() == 'cli') {
            $output = PHP_EOL . $label
                    . PHP_EOL . $output
                    . PHP_EOL;
        } else {
            $output = '<pre>'
                    . $label
                    . htmlspecialchars($output, ENT_QUOTES)
                    . '</pre>';
        }

        if ($echo) {
            echo($output);
        }
        return $output;
    }

}


/**
 * Класс для вывода подсвеченного кода переменной, для удобной отладки
 * Автор BlackWolf - den@rap4street.ru
 * Дата создания 25.06.12
 * Версия 1.0
 * Последнее изминение 26.06.12
 */
class Debug {
    
    //
    // Переменная возвращаемая результат обработки
    //
    private static $returnValue = '';
    
    //
    // Массив для проверки зацикливания ссылок
    //
    private static $recursionVarName = '';
    
    //
    // Разделитель переменныч
    //
    private static $breackVariables = '_______________________________________';
    private static $breackVariablesColor = '#CCCCCC';
    
    //
    // Настройка цыетов
    //
        private static $colorArray = '#0BA07E';
        private static $colorString = '#EEAD0E';
        private static $colorInt = '#F13282';
        private static $colorFloat = '#33C237';
        private static $colorType = '#096AC8';
        private static $colorOther = '#0B3E6F';
        private static $colorBackground = '#EEEEEE';
        private static $colorRecursion = '#E13300';
        
    //
    // PRE PRINT_R
    //
    static public function print_r($variable)
    {
        echo '<pre>'. print_r($variable, TRUE) .'</pre>';
    }
        
    //
    // Функция выдающая результат обработки на экран
    //
    static public function var_dump()
    {
        $args = func_get_args();
        $inc = 0;
        $argNum = count($args);
        foreach ($args as $value) {
            $inc++;
            self::_sort_var_dump_line($value, 0);
            if ($inc < $argNum)
                self::$returnValue .= '<div style="color: '. self::$breackVariablesColor  .'; padding: 4px">'. self::$breackVariables  .'</div>';
        }
        echo '<div style="font-size: 13px; font-family: Tahoma, Arial, Times New Romal; background-color: '. self::$colorBackground .'; padding: 4px;">'. self::$returnValue .'</div>';
        self::$returnValue = '';
    }

    //
    // Функция возвращаемая результат обработки
    //
    static public function var_dump_return()
    {
        $args = func_get_args();
        foreach ($args as $value) {
            self::_sort_var_dump_line($value, 0);
        }
        $return = self::$returnValue;
        self::$returnValue = '';
        return '<div style="font-size: 13px; font-family: Tahoma, Arial, Times New Romal">'. $return .'</div>';
    }
    
    //
    // Сортировка переменных и значений
    //
    private static function _sort_var_dump_line($var, $level)
    {
        if ( $level <= 40 )
            switch (gettype($var)) {
                case 'array':
                    self::_sort_var_dump_array($var, $level);
                    break;
                case 'string':
                    self::_sort_var_dump_string($var, $level);
                    break;
                case 'integer':
                    self::_sort_var_dump_int($var, $level);
                    break;
                case 'double':
                    self::_sort_var_dump_float($var, $level);
                    break;
                case 'boolean':
                    self::_sort_var_dump_bool($var, $level);
                    break;
                case 'NULL':
                    self::_sort_var_dump_null($var, $level);
                    break;
                case 'object':
                    self::_sort_var_dump_object($var, $level);
                    break;
                default:
                    self::_sort_var_dump_unknown($var, $level);
                    break;
            }
        else
            self::$returnValue .= '...';
    }
    
    //
    // Установка уровня отступов
    //
    private static function _set_indentation_level($level = 0)
    {
        $return = '';
        for ($i=0;$i<$level;$i++)
        {
            $return .= '&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $return;
    }
    
    //
    // Массив
    //
    private static function _sort_var_dump_array($var, $level = 0, $isObject = FALSE)
    {
        //$arrayRecursion
        $length = count($var);
        if ($length > 0)
        {
            self::$returnValue .= '<div style="color:'. self::$colorArray .'">'. self::_set_indentation_level($level) . ($isObject ? ('Object('. get_class($var) .')') : 'Array' ) .' ('. $length .') {</div>'; 
            
            foreach ($var as $key => $value) 
            {
                if ( self::_is_recursive_variable($value) )
                {
                    self::$returnValue .= '<div style="color:'. self::$colorOther .'">'. self::_set_indentation_level($level+1) . ($isObject ? '{' : '[' )  .'<span style="color:'. self::$colorString .'">\''. $key .'\'</span>'. ($isObject ? '}' : ']' ) .' = <span style="color:'. self::$colorRecursion .'">*RECURSION OR LINK FOR (<strong>$'. self::$recursionVarName .'</strong>)* <i><sub>variable name may be incorrect</sub></i></span></div>';
                }
                else
                {
                    self::$returnValue .= '<div style="color:'. self::$colorOther .'">'. self::_set_indentation_level($level+1) .($isObject ? '{' : '[' )  .'<span style="color:'. self::$colorString .'">\''. $key .'\'</span>'. ($isObject ? '}' : ']' ) .' = </div>';
                        self::_sort_var_dump_line($value, $level+2);
                }
            }
            self::$returnValue .= '<div style="color:'. self::$colorArray .'">'. self::_set_indentation_level($level) .'}</div>';
        }
        else
        {
            self::$returnValue .= '<div style="color:'. self::$colorArray .'">'. self::_set_indentation_level($level) .'Array (0) {}</div>';
        }
    }
    
    //
    // 
    //
    private static function _is_recursive_variable(&$var)
    {
        $type = gettype($var);
        if ( $type == 'array' )
        {
            $varCopy = $var;
            foreach ($var as $key => $val) 
            {
                if ( is_array($varCopy[$key]) )
                {
                    $varCopy[$key]['_____bw_test_recursive'] = TRUE;
                    if (isset($var[$key]['_____bw_test_recursive'])) 
                    {
                        $vname = self::_print_var_namevname($val);
                        self::$recursionVarName = empty($vname) ? $key : $vname;
                        unset($var[$key]['_____bw_test_recursive']);
                        return TRUE;
                    }
                }
            }
            unset($varCopy);
        }
        elseif ( $type == 'object' )
        {
            $varCopy = $var;
            foreach ($var as $key => $val) 
            {
                if ( is_object($varCopy->$key) )
                {
                    $varCopy->$key->_____bw_test_recursive = TRUE;
                    if (isset($var->$key->_____bw_test_recursive)) 
                    {
                      unset($var->$key->_____bw_test_recursive);
                      return TRUE;
                    }
                }
            }
            unset($varCopy);
        }
        else
        {
            return FALSE;
        }
    }
    
    //
    // Строка
    //
    private static function _sort_var_dump_string($var, $level = 0)
    {
        self::$returnValue .= '<div style="color:'. self::$colorType .'">'. self::_set_indentation_level($level) .'(String) <span style="color:'. self::$colorString .'">\''. $var .'\'</span></div>';
    }
    
    //
    // Число
    //
    private static function _sort_var_dump_int($var, $level = 0)
    {
        self::$returnValue .= '<div style="color:'. self::$colorType .'">'. self::_set_indentation_level($level) .'(Int) <span style="color:'. self::$colorInt .'">'. $var .'</span></div>';
    }
    
    //
    // Число с плавающей точкой
    //
    private static function _sort_var_dump_float($var, $level = 0)
    {
        self::$returnValue .= '<div style="color:'. self::$colorType .'">'. self::_set_indentation_level($level) .'(Float) <span style="color:'. self::$colorFloat .'">'. $var .'</span></div>';
    }
    
    //
    // Число с плавающей точкой
    //
    private static function _sort_var_dump_bool($var, $level = 0)
    {
        self::$returnValue .= '<div style="color:'. self::$colorType .'">'. self::_set_indentation_level($level) .'(Boolean) '. ($var ? 'TRUE' : 'FALSE') .'</div>';
    }
    
    //
    // Число с плавающей точкой
    //
    private static function _sort_var_dump_null($var, $level = 0)
    {
        self::$returnValue .= '<div style="color:'. self::$colorType .'">'. self::_set_indentation_level($level) .'NULL</div>';
    }
    
    //
    // Число с плавающей точкой
    //
    private static function _sort_var_dump_object($var, $level = 0)
    {
        self::_sort_var_dump_array($var, $level, TRUE);
    }
    
    //
    // Число с плавающей точкой
    //
    private static function _sort_var_dump_unknown($var, $level = 0)
    {
        self::$returnValue .= '<div style="color:'. self::$colorType .'">'. self::_set_indentation_level($level) .'<span style="color:#bbb">Unknown type</span></div>';
    }
    
    //
    // Нолучение имени переменной
    //
    private static function _print_var_namevname (&$var, $scope=false, $prefix='unique', $suffix='value')
    {
      if($scope) $vals = $scope;
      else      $vals = $GLOBALS;
      $old = $var;
      $var = $new = $prefix.rand().$suffix;
      $vname = FALSE;
      foreach($vals as $key => $val) {
        if($val === $new) $vname = $key;
      }
      $var = $old;
      return $vname;
    }
}
