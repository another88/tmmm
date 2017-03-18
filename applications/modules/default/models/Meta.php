<?php
class Meta extends MetaModelBase
{
    public $tableName='meta';  
    
    public function getMeta($code)
    {
        $sql = 'SELECT *
                    FROM `meta`
                    WHERE `deleted` = 0
                        AND `code` = '.$this->_db->quote($code);
        return $this->_db->fetchRow($sql);
    }       
}
