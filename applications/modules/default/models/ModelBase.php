<?php

/**
 * ModelBase class
 * 
 * @author a.poteryahin@gmail.com
 * updated: 12/17/08 
 */

class ModelBase
{
    
    protected $_db;
    
    public function __construct($dataBase = null)
    {
        $this->_db = $dataBase;
    }
    
     /**
     * @param  mixed $db Either an Adapter object, or a string naming a Registry key
     * @return provides a fluent interface
     */
    protected final function _setAdapter($db)
    {
        $this->_db = $db;
        return $this;
    }

    /**
     * Gets the Zend_Db_Adapter_Abstract for this particular object.
     *
     * @return Zend_Db_Adapter_Abstract
     */
    public final function getAdapter()
    {
        return $this->_db;
    }
    
    /**
     * prepares pagin control (zend one is ugly)
     * @return string 
     * @param $totalRows int total rows for pagination
     * @param $currentPage int curren page number
     * @param $rowsOnPage int rows per page
     * @param $url string url used for pagination 
     * @param $class string[optional] css class used for every page link
     */
    
    
    public function pagingPrepare($totalRows, $currentPage, $rowsOnPage, $url, $hidelinks = null, $class = '')
    {
        $currentPage = intval($currentPage);
        if ($currentPage <= 0) {
            $currentPage = 1;
        }
        $currentDecimal = floor($currentPage / 10);
        $currentHundred = floor($currentPage / 100);

        //formimg result paging string
        $totalPages = ($rowsOnPage<=0?1:ceil($totalRows / $rowsOnPage));
        $totalDecimal = floor($totalPages / 10);
        $totalHundred = floor($totalPages / 100);

        $arrLinks = array();
        // hundred links 100, 200, 300
        for ($i = 1; $i <= $totalHundred; $i++)
            $arrLinks[] = ($i * 100);

        // decimal links 10, 20, 30 in current hundred
        for ($i = ($currentHundred * 10 + 1); $i <= min(($currentHundred + 1) * 10, $totalDecimal); $i++)
            $arrLinks[] = ($i * 10);

        // pages links in current decade
        for ($i = ($currentDecimal * 10 + 1); $i < min(($currentDecimal * 10) + 10, $totalPages+1); $i++)
            $arrLinks[] = $i;
        // sort links
        $arrLinks = array_unique($arrLinks);
        sort($arrLinks, SORT_NUMERIC);

        $previousCaption = 'Back';
        $nextCaption = 'Next';

        // start and end rows
        $startRow = (($currentPage - 1) * $rowsOnPage) + 1;
        $endRow = min($startRow + $rowsOnPage - 1, $totalRows);

        $res = '<div class="pager'.(!empty($class)?' '.$class:'').'">';

        $res .= ($totalRows > 0?' Page <strong>'.$currentPage.'</strong> from <strong>'.$totalPages.'</strong>':'') . '&nbsp;&nbsp;';
        if ($totalRows > $rowsOnPage) {
            if ($currentPage > 1) {
                $res .= '<a href="'.str_replace('{page}', $currentPage-1, $url).'" title="Back Page" class="back">'.$previousCaption.'</a> &nbsp; ';
            }
            else {
              $res .= '<span class="back">'.$previousCaption.'</span> &nbsp; ';
            }

            if(empty($hidelinks)){
                foreach ($arrLinks as $val) {
                    $res = $res." ";
                    if ($val != $currentPage)
                    $res .= '<a href="'.str_replace('{page}', $val, $url).'" title="'.$val.'">'.$val.'</a> &nbsp; ';
                    else
                    $res .= '<strong>'.$val.'</strong>&nbsp;';
                    $res .= ' ';
                }
            }
            if ($currentPage < $totalPages) {
                $res .= '<a href="'.str_replace('{page}', $currentPage+1, $url).'" title="Next Page" class="next">'.$nextCaption.'</a> &nbsp; ';
            }
            else {
                $res .= '<span class="next">'.$nextCaption.'</span> &nbsp; ';
            }
        }
        $res .= '</div>';

        return $res;
    }
    
    /*
     * Paging for Front
     * Return Associated array
     * spizdil iz ecti
     */

    public function pagingPrepareFront($totalRows, $currentPage, $rowsOnPage, $url, $hidelinks = null, $class = '')
    {
        $currentPage = intval($currentPage);
        if ($currentPage <= 0) {
            $currentPage = 1;
        }
        $currentDecimal = floor($currentPage / 10);
        $currentHundred = floor($currentPage / 100);

        //formimg result paging string
        $totalPages = ($rowsOnPage<=0?1:ceil($totalRows / $rowsOnPage));
        $totalDecimal = floor($totalPages / 10);
        $totalHundred = floor($totalPages / 100);

        $arrLinks = array();
        // hundred links 100, 200, 300
        for ($i = 1; $i <= $totalHundred; $i++)
            $arrLinks[] = ($i * 100);

        // decimal links 10, 20, 30 in current hundred
        for ($i = ($currentHundred * 10 + 1); $i <= min(($currentHundred + 1) * 10, $totalDecimal); $i++)
            $arrLinks[] = ($i * 10);

        // pages links in current decade
        for ($i = ($currentDecimal * 10 + 1); $i < min(($currentDecimal * 10) + 10, $totalPages+1); $i++)
            $arrLinks[] = $i;
        // sort links
        $arrLinks = array_unique($arrLinks);
        sort($arrLinks, SORT_NUMERIC);
        
        // start and end rows
        $startRow = 1;
        $endRow = $totalPages;
        $res = '<div class="pagingNav">';
        $prevPageNumber = $currentPage-1;
        $nextPageNumber = $currentPage+1;
        if ($totalRows > $rowsOnPage) 
        {
            if ($currentPage > 1) 
            {
                $res .= '<div class="pagingItem buttonPage" ><a href="'.str_replace('{page}', $startRow, $url).'" title="В начало">В начало</a></div>';
                $res .= '<div class="pagingItem buttonPage" ><a href="'.str_replace('{page}', $prevPageNumber, $url).'" title="Назад">Назад</a></div>';
            }
            else 
            {
              $res .= '<div class="pagingItem buttonPageOff">В начало</div>';
              $res .= '<div class="pagingItem buttonPageOff">Назад</div>';
            }         
            $hidelinks = NULL;
            if(empty($hidelinks))
            {
                foreach ($arrLinks as $val) 
                {
                    if ($val != $currentPage)
                    {
                        $res .= '<div class="pagingItem"><a href="'.str_replace('{page}', $val, $url).'" title="'.$val.'">'.$val.'</a></div>';
                    }
                    else
                    {
                        $res .= '<div class="pagingItem activePage">'.$val.'</div>';
                    }                  
                }
            }
            if ($currentPage < $totalPages) 
            {
                $res .='<div class="pagingItem buttonPage"><a href="'.str_replace('{page}', $nextPageNumber, $url).'" title="Вперед">Вперед</a></div>';
                $res .='<div class="pagingItem buttonPage noMarginRight"><a href="'.str_replace('{page}', $endRow, $url).'" title="В конец">В конец</a></div>';
            }
            else 
            {
                $res .='<div class="pagingItem buttonPageOff">Вперед</div>';
                $res .='<div class="pagingItem buttonPageOff noMarginRight">В конец</div>';
            }
        }
        else
        {
            $res .= '<div class="pagingItem buttonPageOff">В начало</div>';
            $res .= '<div class="pagingItem buttonPageOff">Назад</div>';
            $res .= '<div class="pagingItem activePage">1</div>';
            $res .= '<div class="pagingItem buttonPageOff">Вперед</div>';
            $res .= '<div class="pagingItem buttonPageOff noMarginRight">В конец</div>';
        }
        $res .= '<div class="clr"></div></div>';        
        return $res;
    }
    
    public function pagingPrepareJavascript($totalRows, $currentPage, $rowsOnPage, $hidelinks = null)
    {
        $currentPage = intval($currentPage);
        if ($currentPage <= 0) {
            $currentPage = 1;
        }
        $currentDecimal = floor($currentPage / 10);
        $currentHundred = floor($currentPage / 100);

        //formimg result paging string
        $totalPages = ($rowsOnPage<=0?1:ceil($totalRows / $rowsOnPage));
        $totalDecimal = floor($totalPages / 10);
        $totalHundred = floor($totalPages / 100);

        $arrLinks = array();
        // hundred links 100, 200, 300
        for ($i = 1; $i <= $totalHundred; $i++)
            $arrLinks[] = ($i * 100);

        // decimal links 10, 20, 30 in current hundred
        for ($i = ($currentHundred * 10 + 1); $i <= min(($currentHundred + 1) * 10, $totalDecimal); $i++)
            $arrLinks[] = ($i * 10);

        // pages links in current decade
        for ($i = ($currentDecimal * 10 + 1); $i < min(($currentDecimal * 10) + 10, $totalPages+1); $i++)
            $arrLinks[] = $i;
        // sort links
        $arrLinks = array_unique($arrLinks);
        sort($arrLinks, SORT_NUMERIC);
        
        // start and end rows
        $startRow = 1;
        $endRow = $totalPages;
        $res = '<div class="pagingNav">';
        $prevPageNumber = $currentPage-1;
        $nextPageNumber = $currentPage+1;
        if ($totalRows > $rowsOnPage) 
        {
            if ($currentPage > 1) 
            {
                $res .= '<div class="pagingItem buttonPage" onclick="toConstructorPage(\''.$startRow.'\');">В начало</div>';
                $res .= '<div class="pagingItem buttonPage" onclick="toConstructorPage(\''.$prevPageNumber.'\');">Назад</div>';
            }
            else 
            {
              $res .= '<div class="pagingItem buttonPageOff">В начало</div>';
              $res .= '<div class="pagingItem buttonPageOff">Назад</div>';
            }
            $hidelinks = NULL;
            if(empty($hidelinks))
            {
                foreach ($arrLinks as $val) 
                {
                    if ($val != $currentPage)
                    {
                        $res .= '<div class="pagingItem"><a href="javascript:void(0);" onclick="toConstructorPage(\''.$val.'\');" title="'.$val.'">'.$val.'</a></div>';
                    }
                    else
                    {
                        $res .= '<div class="pagingItem activePage">'.$val.'</div>';
                    }
                }
            }
            if ($currentPage < $totalPages) 
            {
                $res .='<div class="pagingItem buttonPage" onclick="toConstructorPage(\''.$nextPageNumber.'\');">Вперед</div>';
                $res .='<div class="pagingItem buttonPage noMarginRight" onclick="toConstructorPage(\''.$endRow.'\');">В конец</div>';
            }
            else 
            {
                $res .= '<div class="pagingItem buttonPageOff">Вперед</div>';
                $res .= '<div class="pagingItem buttonPageOff noMarginRight">В конец</div>';
            }
        }
        else
        {
            $res .= '<div class="pagingItem buttonPageOff">В начало</div>';
            $res .= '<div class="pagingItem buttonPageOff">Назад</div>';
            $res .= '<div class="pagingItem activePage">1</div>';
            $res .= '<div class="pagingItem buttonPageOff">Вперед</div>';
            $res .= '<div class="pagingItem buttonPageOff noMarginRight">В конец</div>';
        }
        $res .= '<div class="clr"></div></div>';
        return $res;
    }    
    
    /**
     * get data for current page
     * @return rowset for current page
     * @param $sql string 
     * @param $select string
     * @param $orderBy string
     * @param $pageLength int total rows per page
     * @param $page int[optional] page number
     */
    protected function _pagingQuery($sql, $select = "SELECT *", $orderBy = "", $pageLength = 0, $page = 1, $pk="") 
    {    
        
        $page = intval($page);
        if (0 == $page) {
            $page = 1;
        }
        $pageLength = intval($pageLength);
        if (0 == $pageLength) {
            $pageLength = false;
        }
        //echo "SELECT count(*) AS total ".$sql."<br/>";
//        $totalCountRow = $this->_db->fetchAll("SELECT count(*) AS total ".$sql);
        //Ошибка с получением количества записей была в модели News функция search
        $pk = NULL;
        $totalCountRow = $this->_db->fetchAll("SELECT " .(empty($pk)? " * ": $pk). " " .$sql);
        $totalCountRowValue = count($totalCountRow);
//        $totalCountRowValue = 0;
//        for($i=0;$i<count($totalCountRow);$i++){
//            
//        }
        $res = array(
            'pageLength' => intval($pageLength), 
            'total' => $totalCountRowValue
        );
        
        if ($page > 1 && (($page * $pageLength) >= $res['total'])) {
            $page = ceil($res['total'] / $pageLength);
        }      
         $res['page'] = $page;
        $res['offset'] = ($page - 1) * $pageLength;
        // Offset не может быть отрицательным
        $res['offset'] = $res['offset'] < 0 ? 0 : $res['offset'];
//        var_dump($select." ".$sql." ".$orderBy.((false != $pageLength)?" LIMIT ".$res['offset'].", ".$pageLength:""));exit;
        $res['data'] = $this->_db->fetchAll($select." ".$sql." ".$orderBy.((false != $pageLength)?" LIMIT ".$res['offset'].", ".$pageLength:""));
//        var_dump($res['data']);//exit;
        return $res;
    }

    /**
     * Prepare string for database.
     *
     * @param string $str
     * @return string
     */
    protected final function _escape($str)
    {
        $str = $this->_db->quote(str_replace('"', '&quot;',stripslashes(strip_tags(trim($str), ENT_QUOTES))));
        return $str;
    }
    //--------------------------------------------------------------------------
    public function clearEntities()
    {
		$this->_db->query("TRUNCATE TABLE post");
		$this->_db->query("TRUNCATE TABLE postcategory");
		$this->_db->query("TRUNCATE TABLE postcategorypost");
		$this->_db->query("TRUNCATE TABLE user");
    }    
    /**
     * convert russian date to english format 
     * @return string 'yyyy-mm-dd'
     * @param $tt string 'dd.mm.yyyy'
     */
    protected final function _russianDateConvert($tt)
    {
        $tmp = explode('.',$tt);
        if (count($tmp)==2) {
            $tmp[2] = date('Y',time());
        }
        return $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
    }
    
    /**
     * Validates input data.
     */
    public function validate()
    {
        throw new Exception();
    }
    
    /**
     * List data.
     */
    public function listing($pageLength = 0, $page = 1, $filter = NULL)
    {
        throw new Exception();    
    }
    
    /**
     * Get entity details.
     */
    public function details($id)
    {
        throw new Exception();    
    }
    
    /**
     * Save entity data.
     */
    public function save($data, $id = NULL)
    {
        throw new Exception();    
    }
    
    /**
     * Remove entity.
     */
    public function delete($id)
    {
        throw new Exception();    
    }

    /**
     * Is the records exists in database.
     */
    public function exists()
    {
        throw new Exception();    
    }

    public function clearInputText($text)
    {
        ini_set('pcre.recursion_limit', 1000);
        $text = preg_replace("@<script[^>]*>.+</script[^>]*>@i", "", $text);
        $text = preg_replace("@<meta[^>]*/>@i", "", $text);
        $text = preg_replace("@<link[^>]*/>@i", "", $text);
        $text = preg_replace("@<style[^>]*>.+</style[^>]*>@i", "", $text);
        $text = preg_replace("@<xml[^>]*>.+</xml[^>]*>@i", "", $text);
        $text = preg_replace("@<o:p[^>]*>.+</o:p[^>]*>@i", "", $text);
        return $text;
    }

    public function listingMeta($tableName ,$pageLength = 0, $page = 1, $filter = NULL)
    {
        global $metadata;

        $meta = $metadata[$tableName];
        $select = 'SELECT ';
        if(!empty($filter['fields'])) {
            $select.= ' '.$filter['fields'];
            unset($filter['fields']);
        } else
            $select.= '* ';
        $sql = 'FROM ' . $meta['name'] . ' WHERE deleted = 0';
        if (!empty($filter)) {
            foreach ($filter as $key => $value) {
                if($key != 'order')
                    $sql .= (isset ($value) ? ' AND ' . $key . ' = ' . $this->_db->quote($value) . ' ' : ' ');
            }
        }
        if(isset($meta['fields']))
            $fields = array_keys($meta['fields']);

        if(!empty($filter['order']))
            $orderBy = ' '.$filter['order'];
        elseif(isset($fields[0]) && empty($filter['order']))
            $orderBy = 'ORDER BY ' . $fields[0] . ' DESC ';
        else
            $orderBy = '';

        $list = $this->_pagingQuery($sql, $select, $orderBy, $pageLength, $page);
        //echo $select.$sql.$orderBy.'<br />';
        return $list;
    }
    
}