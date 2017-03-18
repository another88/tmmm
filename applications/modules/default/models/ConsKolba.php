<?php
class ConsKolba extends MetaModelBase
{
    public $tableName='conskolba';  
    
    public function getData()
    {
        $sql = 'SELECT *, consKolbaId as elementId, "conskolba" as imageDir
                    FROM '.$this->tableName.'
                    WHERE `deleted` = 0
                        AND `approved` = 1';
        return $this->_db->fetchAll($sql);
    }      
}
