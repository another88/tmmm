<?php
/*
 *     Smarty plugin
 * -------------------------------------------------------------
 * File:        function.drawb.php
 * Type:        function
 * Name:        drawb
 * Description: Draw button
 *
 * -------------------------------------------------------------
 * Parameters:
 * - inner         = inner buuton text
 * - size          = set button size(small or big)
 * - click         = click action
 * - active        = active status(on, off)
 * -------------------------------------------------------------
 * Example usage:
 *
 * {drawb inner="Preview" size="small" click="approved(2);" active="on"} 
 */

function smarty_function_drawb($params, &$smarty) {
    if(!isset($params['size']) || empty($params['size']))
        $params['size'] = 'small';
    if(!isset($params['click']))
        $params['click'] = '';    
    if(!isset($params['active']) || empty($params['active']))
        $params['active'] = 'on';    
//    $params['href'] = trim(str_replace("'", "", $params['href']));
    $innerText = trim( isset($params['inner'])?$params['inner']:' ' );
    $buttonHtml = '';
    if( $params['active'] == 'on' ){
        $buttonHtml .= '<div class="buttonLeftBorder_'.$params['size'].'"></div>';
        $buttonHtml .= '<div class="buttonCenterBorder_'.$params['size'].'"  
                            onmouseover="buttonHover(this);" 
                            onmouseout="buttonUnhover(this);"
                            onclick="'.$params['click'].'">
                                '.$innerText.'
                                <div class="clr"></div>
                                <span class="whiteText_'.$params['size'].'">'.$innerText.'</span>
                                <div class="clr"></div>                        
                        </div>';
        $buttonHtml .= '<div class="buttonRightBorder_'.$params['size'].'"></div>';
    } else {
        $buttonHtml .= '<div class="buttonLeftBorder_off"></div>';
        $buttonHtml .= '<div class="buttonCenterBorder_off">
                                '.$innerText.'
                                <div class="clr"></div>
                                <span class="whiteText_off">'.$innerText.'</span>
                                <div class="clr"></div>                        
                        </div>';
        $buttonHtml .= '<div class="buttonRightBorder_off"></div>';        
    }
    echo $buttonHtml;
}
?>
