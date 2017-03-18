<?php
class ConsTrybka extends MetaModelBase
{
    public $tableName='constrybka';  
    
    public function getData()
    {
        $sql = 'SELECT *, consTrybkaId as elementId, "constrybka" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }        
}
