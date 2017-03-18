<?php
class ConsShlang extends MetaModelBase
{
    public $tableName='consshlang';  
    
    public function getData()
    {
        $sql = 'SELECT *, consShlangId as elementId, "consshlang" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }        
}
