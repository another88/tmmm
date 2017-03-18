<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate_text modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate_text<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *              adding link to last words.
 *
 * @author   Aleinikov Sergey <slide.step at gmail dot com>
 *
 * @param string $text
 * @param string $link
 * @param int $counttext
 * @param int $linkWords
 * @param string $sep
 * @return string 
 */
    function smarty_modifier_truncate_text($text, $link, $counttext = 10, $linkWords = 3, $sep = ' ')
    {
        $words = explode($sep, $text);
        if (count($words) > $counttext) {
            $array = array_slice($words, 0, $counttext);
            $array = array_chunk($array, $counttext - $linkWords);
            $text = join($sep, $array[0]) . ' <a href="' . $link . '">' . join($sep, $array[1]) . '</a>';
        }
        return $text;
    }

?>
