<?php
class Taste extends MetaModelBase
{
    public $tableName='taste';  
    
    public function urlDetail($url)
    {
        $sql = 'SELECT *
                    FROM `taste`
                    WHERE `deleted` = 0
                        AND `approved` = 1
                        AND `url` = '.$this->_db->quote($url);
        return $this->_db->fetchRow($sql);
    }    
}
